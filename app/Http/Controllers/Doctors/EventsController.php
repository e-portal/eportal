<?php

namespace Fresh\Estet\Http\Controllers\Doctors;

use Fresh\Estet\Eadv;
use Fresh\Estet\Http\Requests\EventRequest;
use Fresh\Estet\Jobs\EventSignup;
use Illuminate\Http\Request;
use Fresh\Estet\Repositories\AdvertisingRepository;
use Fresh\Estet\Repositories\ArticlesRepository;
use Fresh\Estet\Repositories\BlogsRepository;
use Fresh\Estet\Repositories\CitiesRepository;
use Fresh\Estet\Repositories\CountriesRepository;
use Fresh\Estet\Repositories\EventCategoriesRepository;
use Fresh\Estet\Repositories\EventsRepository;
use DB;
use Fresh\Estet\Repositories\OrganizersRepository;
use Fresh\Estet\Repositories\PremiumsRepository;
use Cache;
use Carbon\Carbon;
use Fresh\Estet\Repositories\SeoRepository;
use Validator;

class EventsController extends DocsController
{
    protected $repository;
    protected $countries;
    protected $cities;
    protected $cats;
    protected $organizer;
    protected $prem;

    public function __construct(
        ArticlesRepository $article,
        EventsRepository $repository,
        CountriesRepository $countries,
        CitiesRepository $cities,
        EventCategoriesRepository $cats,
        OrganizersRepository $organizer,
        PremiumsRepository $prem,
        AdvertisingRepository $adv,
        SeoRepository $seo_rep,
        BlogsRepository $blog
    )
    {
        parent::__construct($article, $adv, $seo_rep, $blog);
        $this->repository = $repository;
        $this->countries = $countries;
        $this->cities = $cities;
        $this->cats = $cats;
        $this->organizer = $organizer;
        $this->prem = $prem;
    }

    /**
     * @param EventRequest $request
     * @param bool|false $event
     * @return $this
     * @throws \Exception
     * @throws \Throwable
     */
    public function show(EventRequest $request, $event = false)
    {
        Cache::flush();
        $this->getSidebar();
        if ($event) {

            $this->title = $event->title;

            $this->css = '
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/meropryyatyya-vnutrennyaya.css">
            ';

            $this->content = Cache::remember('event_content-' . $event->alias, 60, function () use ($event) {
                if (!empty($event->seo)) {
                    $event->seo = $this->repository->convertSeo($event->seo);
                } else {
                    $event->seo = new \stdClass();
                }
                $event->seo->og_image = asset('/images/event/main') . '/' . $event->logo->path;

                $event->created = $this->repository->convertDate($event->created_at);
                $event->load('logo');
                $event->load('slider');
                $event->load('comments');

                $similar = $this->repository->getSimilar($event->id, $event->organizer_id, $event->cat_id);

                return view('doc.events.event')->with(['event' => $event, 'similars' => $similar, 'sidebar' => $this->sidebar])->render();
            });

            $this->seo = $event->seo ?? '<img src="' . asset('estet') . '/img/estet.png" >';

            $this->repository->displayed($event);

            return $this->renderOutput();
        }


        $this->css = '
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/events.css">
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/events-media.css">
            ';
        $this->js = '
            <script src="' . asset('js') . '/events.js"></script>
        ';
        $prems_ids = Cache::remember('event_prem', 60, function () {
            return $this->prem->getPremIds('event');
        });

        $this->getSidebar();

        $where = false;
        $where1 = false;
        $where_in = false;
        $children = false;
        if (!empty($request->all())) {
            $data = $request->all();

            if (!empty($data['country'])) {
                $where[] = ['country_id', $data['country']];
                $where1[] = ['country_id', $data['country']];
            }

//            $request->session()->forget('city');
            if (!empty($data['city'])) {
//                $request->session()->flash('city', $data['city']);
                $where[] = ['city_id', $data['city']];
                $where1[] = ['city_id', $data['city']];
            }

            if (!empty($data['cat']) && (0 != $data['cat'])) {
                $where[] = ['cat_id', $data['cat']];
                $where1[] = ['cat_id', $data['cat']];
            }

            if (!empty($data['organizer'])) {
                $children = $this->organizer->getChildren($data['organizer']);
                $where_in[] = $data['organizer'];
                $where_in1[] = $data['organizer'];
                if ($children->isNotEmpty()) {
                    foreach ($children as $child) {
                        $where_in[] = $child->id;
                        $where_in1[] = $child->id;
                    }
                }
            }
        }

        if ($request->has('year')) {
            $year = $request->get('year');
        } else {
            $year = date('Y');
        }

        if ($request->has('month')) {
            $month = $request->get('month');
        } else {
            $month = date('m');
        }

        $calendar_vars['first'] = date('D', mktime(0, 0, 0, $month, 1, $year));
        $calendar_vars['last_number'] = date('t', mktime(0, 0, 0, $month, 1, $year));
        $calendar_vars['year'] = $year;
        $calendar_vars['month'] = $month;

//        $day_number = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $where[] = ['stop', '>=', date('Y-m-01', mktime(0, 0, 0, $month, 1, $year))];
        $where[] = ['start', '<=', date('Y-m-t', mktime(0, 0, 0, $month, 1, $year))];

        $calendar = $this->repository->getWithoutPrems($where_in, false, $where, $prems_ids, false);
//        dd($calendar);
        if (!empty($calendar[0])) {
            $calendar = $this->repository->convertStop($calendar);
            $where1[] = ['stop', '>=', date('Y-m-d', mktime(0, 0, 0, $month, date('d'), $year))];
            $where1[] = ['start', '>=', date('Y-m-d', mktime(0, 0, 0, $month, 1, $year))];
        } else {
            $where_in = false;
            $where1 = false;
            $where1[] = ['stop', '>=', date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y')))];
            $where1[] = ['start', '>=', date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')))];
        }
        $events = $this->repository->getWithoutPrems($where_in, true, $where1, $prems_ids, false);

        $vars = [
            'events' => $events,
            'countries' => Cache::remember('countries', 600, function () {
                return $this->countries->getCountriesSelect();
            }),
            'cities' => $this->cities->citiesSelect(),
            'cats' => Cache::remember('eventCats', 600, function () {
                return $this->cats->catSelect();
            }),
            'organizer' => Cache::remember('organizer', 600, function () {
                return $this->organizer->organizerSelect();
            }),
            'prems' => Cache::remember('prems', 600, function () use ($prems_ids) {
                return $this->repository->getPrems($prems_ids);
            }),
            'children' => $children,
            'calendar' => $calendar,
            'calendar_vars' => $calendar_vars,
            'sidebar' => $this->sidebar,
        ];
        $this->getSeo('meropriyatiya');
        $this->content = view('doc.events.index')->with($vars)->render();
        return $this->renderOutput();
    }

    /**
     * @return bool
     */
    public function getSidebar()
    {
//        last
        $lasts = Cache::remember('events_sidebar_lasts', 60, function () {
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')]);
            return $this->repository->get(['title', 'alias', 'created_at'], 2, false, $where, ['created_at', 'desc']);
        });
//        last

//        most displayed
        $articles = Cache::remember('events_sidebar_popular', 60, function () {
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'docs']);
            return $this->a_rep->mostDisplayed(['title', 'alias', 'created_at'], $where, 10, ['view', 'asc']);
        });
        $articles = $articles->random(2);
//        most displayed

        $advertisings = Cache::remember('docs_sidebar_adv', 24 * 60, function () {
            return $this->adv_rep->getSidebar('doc');
        });

        $advertising['sidebar'] = $advertisings['sidebar']->random();
        $advertising['sidebar_2'] = $advertisings['sidebar_2']->random();


        $ad_slider = $this->repository->getAd(new Eadv());
//dd($ad_slider);
        $this->sidebar = view('doc.events.sidebar')
            ->with(['lasts' => $lasts, 'articles' => $articles, 'advertising' => $advertising, 'ad_slider' => $ad_slider])
            ->render();
        return true;
    }

    public function signup(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required|string|max:255',
                'source' => 'required|digits_between:1,10|max:4294967295',
                'phone' => ['required', 'between:4,255', 'regex:#^[0-9()\,\-\s\+]+$#'],
            ]);

            if ($validator->fails()) {
                return \Response::json(['error' => $validator->errors()]);
            }
            $content = $request->except('_token');
            $email = $this->repository->findById($content['source']);

            if (null == $email) {
                return \Response::json(['error' => 'Что-то пошло не так, попробуйте записаться позже']);
            }
            $content['title'] = $email->title;
//            dd($content);
            dispatch(new EventSignup($email->extmail, $content));
            return \Response::json(['success' => 'Письмо организатору отправлено']);
        } else {
            abort(404);
        }
    }
}
