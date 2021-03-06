<?php

namespace Fresh\Estet\Http\Controllers;

use DB;
use Auth;
use Cache;
use Fresh\Estet\Event;
use Fresh\Estet\Repositories\AdvertisingRepository;
use Fresh\Estet\Repositories\ArticlesRepository;
use Fresh\Estet\Repositories\EventsRepository;
use Menu;

class MainController extends Controller
{
    protected $template = 'main.index';
    protected $vars;
    protected $sidebar = false;
    protected $title;
    protected $footer = false;
    protected $a_rep;
    protected $adv_rep;
    protected $title_img;
    protected $content = false;
    protected $seo = false;
    protected $css = false;
    protected $js = false;

    /**
     * MainController constructor.
     * @param ArticlesRepository $a_rep
     * @param AdvertisingRepository $adv
     */
    public function __construct(ArticlesRepository $a_rep, AdvertisingRepository $adv)
    {
        $this->a_rep = $a_rep;
        $this->adv_rep = $adv;
    }

    /**
     * View
     * @param alias $doc
     * @return view
     */

    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);

        $this->vars = array_add($this->vars, 'seo', $this->seo);
        $this->vars = array_add($this->vars, 'css', $this->css);
        $this->vars = array_add($this->vars, 'js', $this->js);

        $status = session('doc');

        $this->title_img = true;
        $this->vars = array_add($this->vars, 'title_img', $this->title_img);

        if (!empty($this->footer)) {
            $footer = $this->footer;
        } else {
            if ($status) {
                $advertisings = Cache::remember('doc_footer_adv', 24 * 60, function () {
                    return $this->adv_rep->getFooter('doc');
                });

                $adv['text'] = $advertisings->random();

                $footer = view('layouts.footer')->with(['adv' => $adv])->render();
            } else {
                $advertisings = Cache::remember('patient_footer_adv', 24 * 60, function () {
                    return $this->adv_rep->getFooter('patient');
                });

                $adv['text'] = $advertisings->random();

                $footer = view('layouts.footer')->with(['adv' => $adv])->render();
            }
        }
        $this->vars = array_add($this->vars, 'footer', $footer);

        if ($status) {
            $nav = Cache::remember('docsMenu', 600, function () use ($status) {
                $menu = $this->getMenu($status);
                return view('layouts.nav')->with('menu', $menu)->render();
            });
        } else {
            $nav = Cache::remember('patientMenu', 600, function () use ($status) {
                $menu = $this->getMenu($status);
                return view('layouts.nav')->with('menu', $menu)->render();
            });
        }
        $this->vars = array_add($this->vars, 'nav', $nav);

        if (false !== $this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        return view($this->template)->with($this->vars);
    }

    /**
     * @param $status boolean
     * @return mixed Menu Instance
     */
    public function getMenu($status)
    {
        $cats = DB::select('SELECT `name`, `alias` FROM ' . ($status ? 'docsmenuview' : 'patientmenuview'));

        return Menu::make('menu', function ($menu) use ($cats, $status) {
            $route = $status ? 'docs_cat' : 'article_cat';
            foreach ($cats as $cat) {
                if (('Видео' == $cat->name) || ('Видео отзывы' == $cat->name) || ('Интервью' == $cat->name)) {
                    continue;
                }
                $menu->add($cat->name, ['route' => [$route, $cat->alias]]);
            }
        });
    }


    public function getSidebar($status)
    {
//        sidebar
        if ($status) {
//            lasts
            $lasts = Cache::remember('main_sidebar_doc_lasts', 60, function () {
                $events_rep = new EventsRepository(new Event());
                $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')]);
                return $events_rep->get(['title', 'alias', 'created_at'], 2, false, $where, ['created_at', 'desc']);
            });
//            lasts

//              most displayed
            $articles = Cache::remember('main_sidebar_doc_popular', 60, function () {
                $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'docs']);
                return $this->a_rep->mostDisplayed(['title', 'alias', 'created_at'], $where, 10, ['view', 'desc']);
            });
            $articles = $articles->random(2);
//              most displayed

            $advertisings = Cache::remember('docs_sidebar_adv', 24 * 60, function () {
                return $this->adv_rep->getSidebar('doc');
            });

            $advertising['sidebar'] = $advertisings['sidebar']->random();
            $advertising['sidebar_2'] = $advertisings['sidebar_2']->random();

            $this->sidebar = view('main.sidebar')
                ->with(['lasts' => $lasts, 'status' => true, 'articles' => $articles, 'advertising' => $advertising])
                ->render();
        } else {

//            lasts
            $lasts = Cache::remember('main_sidebar_patient_lasts', 60, function () {
                $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'patient']);
                return $this->a_rep->getLast(['title', 'alias', 'created_at'], $where, 2, ['created_at', 'desc']);
            });
//            lasts

//              most displayed
            $articles = Cache::remember('main_sidebar_patient_popular', 60, function () {
                $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'patient']);
                return $this->a_rep->mostDisplayed(['title', 'alias', 'created_at'], $where, 10, ['view', 'desc']);
            });
            $articles = $articles->random(2);
//               most displayed

            $advertisings = Cache::remember('patient_sidebar_adv', 24 * 60, function () {
                return $this->adv_rep->getSidebar('patient');
            });

            $advertising['sidebar_2'] = $advertisings['sidebar_2']->random();

            $this->sidebar = view('main.sidebar')
                ->with(['lasts' => $lasts, 'status' => false, 'articles' => $articles, 'advertising' => $advertising])
                ->render();
        }
        $this->vars = array_add($this->vars, 'sidebar', $this->sidebar);
//        sidebar
    }
}
