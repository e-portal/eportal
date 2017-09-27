<?php

namespace Fresh\Estet\Http\Controllers;

use Fresh\Estet\Repositories\DocratioRepository;
use Fresh\Estet\Repositories\EstablishmentratioRepository;
use Fresh\Estet\Repositories\EstablishmentsRepository;
use Fresh\Estet\Repositories\PersonsRepository;
use Fresh\Estet\Repositories\BlogsRepository;
use Fresh\Estet\Repositories\PremiumsRepository;
use Fresh\Estet\Repositories\AdvertisingRepository;
use Fresh\Estet\Repositories\ArticlesRepository;
use Cache;
use DB;
use Fresh\Estet\Repositories\SeoRepository;
use Illuminate\Http\Request;

class CatalogController extends MainController
{
    protected $prem_rep;
    protected $ratio_rep;
    protected $repository;

    public function __construct(
        ArticlesRepository $a_rep,
        AdvertisingRepository $adv,
        PremiumsRepository $prem_rep,
        EstablishmentratioRepository $ratio_rep,
        EstablishmentsRepository $repository,
        SeoRepository $seoRepository
    )
    {
        parent::__construct($a_rep, $adv);
        Cache::flush();
        $this->css = '
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/katalog-brendu.css">
        ';
        Cache::flush();
        $this->prem_rep = $prem_rep;
        $this->ratio_rep = $ratio_rep;
        $this->repository = $repository;
        $this->seo_rep = $seoRepository;
    }

    public function index()
    {
        abort(404);
    }

    /**
     * View Doctor's Profile
     * @param alias $doc
     * @return view
     */
    public function docs(PersonsRepository $rep, BlogsRepository $blog_rep, DocratioRepository $ratio_rep, Request $request, $doc = false)
    {
        $this->getSidebar(session()->has('doc'));
        if ($doc) {
            $this->content = Cache::remember('doc-' . $doc->id, 24 * 60, function () use ($doc, $blog_rep, $ratio_rep) {
                if (!empty($doc->services)) {
                    $doc->services = json_decode($doc->services);
                }

                if (!empty($doc->expirience)) {
                    $doc->expirience = date_create()->diff(date_create($doc->expirience))->y;
                }
                $doc->load('comments');
                $ratio = $ratio_rep->getRatio($doc->id);
                //  Blogs preview
                $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['user_id', $doc->user_id]);
                $blogs = $blog_rep->get(['alias', 'title', 'created_at'], 3, false, $where, ['created_at', 'desc'], ['blog_img', 'category'], true);

                return view('catalog.profiles.doc_profile')
                    ->with(['profile' => $doc, 'blogs' => $blogs, 'sidebar' => $this->sidebar, 'ratio' => $ratio[0]])
                    ->render();
            });
            $this->title = $doc->name . ' ' . $doc->lastname;
            return $this->renderOutput();
        }
        $this->title = 'Врачи';

        $this->getSeo('catalog/vrachi');

        $this->css .= '
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/katalog.css">
        ';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $this->content = Cache::remember('catalog_doc-' . $currentPage, 60, function () use ($rep) {
            $profiles = $rep->get(['name', 'address', 'phone', 'site', 'alias', 'photo'], false, true, false, false, 'specialties');

            return view('catalog.docs')
                ->with(['title' => $this->title, 'profiles' => $profiles, 'sidebar' => $this->sidebar])
                ->render();
        });
        return $this->renderOutput();
    }

    /**
     * @param alias $clinic
     * @return view
     */
    public function clinics($clinic = false)
    {
        $this->getSidebar(session()->has('doc'));
        if ($clinic) {

            $clinic = $this->repository->convertParams($clinic);
            $clinic->load('comments');

            $ratio = $this->ratio_rep->getRatio($clinic->id);
            $this->content = view('catalog.profiles.clinic')
                ->with(['clinic' => $clinic, 'ratio' => $ratio[0],
                    'sidebar' => $this->sidebar
                ])
                ->render();
            $clinic->seo = $this->repository->convertSeo($clinic->seo);
            if (!empty($clinic->logo) && is_object($clinic->seo)) {
                $clinic->seo->og_image = asset('/images/establishment/main') . '/' . $clinic->logo;
            } else {
                $clinic->seo = new \stdClass();
                $clinic->seo->og_image = '<img src="' . asset('estet') . '/img/estet.png" >';
            }
            $this->seo = $clinic->seo;
            return $this->renderOutput();
        }

        $this->title = 'Клиники';
        $this->getSeo('catalog/kliniki');
        $this->css .= '
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/katalog.css">
        ';

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('catalog-clinic-' . $currentPage, 60, function () {
            $prems_ids = $this->prem_rep->getPremIds('clinic');

            $prems = $this->repository->getPrems($prems_ids);

            $clinics = $this->repository->getWithoutPrems([
                'logo', 'title', 'content', 'alias', 'address'],
                true,
                ['category', 'clinic'],
                $prems_ids);

            return view('catalog.clinics')->with(['clinics' => $clinics, 'prems' => $prems, 'sidebar' => $this->sidebar])->render();

        });

        return $this->renderOutput();
    }

    /**
     * @param alias $salon
     * @return view
     */
    public function distributors($distributor = false)
    {
        $this->getSidebar(session()->has('doc'));
        if ($distributor) {

            $distributor = $this->repository->convertParams($distributor);
            $distributor->load('comments');

            $children = $this->repository->getChildren($distributor->id);
            $ratio = $this->ratio_rep->getRatio($distributor->id);

            $this->content = view('catalog.profiles.distributor')
                ->with(['distributor' => $distributor, 'sidebar' => $this->sidebar,
                    'children' => $children, 'ratio' => $ratio[0]])
                ->render();
            $distributor->seo = $this->repository->convertSeo($distributor->seo);
//            dd($distributor);
            if (!empty($distributor->logo) && is_object($distributor->seo)) {
                $distributor->seo->og_image = asset('/images/establishment/main') . '/' . $distributor->logo;
            } else {
                $distributor->seo = new \stdClass();
                $distributor->seo->og_image = '<img src="' . asset('estet') . '/img/estet.png" >';
            }
            $this->seo = $distributor->seo;
            return $this->renderOutput();
        }
        $this->title = 'Дистрибьюторы';
        $this->getSeo('catalog/distributory');

        $this->css .= '
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/katalog.css">
        ';

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('catalog-distributor-' . $currentPage, 60, function () {
            $prems_ids = $this->prem_rep->getPremIds('distributor');

            $prems = $this->repository->getPrems($prems_ids);

            $distributors = $this->repository
                ->getWithoutPrems(
                    ['logo', 'title', 'content', 'alias', 'address'],
                    true,
                    ['category', 'distributor'],
                    $prems_ids,
                    ['created_at', 'desc']
                );

            return view('catalog.distributors')
                ->with(['distributors' => $distributors, 'prems' => $prems, 'sidebar' => $this->sidebar])
                ->render();
        });

        return $this->renderOutput();
    }

    /**
     * @param alias $brand
     * @return $this
     */
    public function brands($brand = false)
    {
        $this->getSidebar(session()->has('doc'));
        if ($brand) {
            $brand = $this->repository->convertParams($brand);
            $brand->load('comments');

            $parent = $this->repository->findById($brand->parent);

            $ratio = $this->ratio_rep->getRatio($brand->id);

            $this->content = view('catalog.profiles.brand')
                ->with(['brand' => $brand, 'parent' => $parent,
                    'sidebar' => $this->sidebar, 'ratio' => $ratio[0]])
                ->render();

            $brand->seo = $this->repository->convertSeo($brand->seo);
            if (!empty($brand->logo) && is_object($brand->seo)) {
                $brand->seo->og_image = asset('/images/establishment/main') . '/' . $brand->logo;
            } else {
                $brand->seo = new \stdClass();
                $brand->seo->og_image = '<img src="' . asset('estet') . '/img/estet.png" >';
            }
            $this->seo = $brand->seo;
            
            return $this->renderOutput();
        }

        $this->title = 'Бренды';
        $this->getSeo('catalog/brendy');

        $this->css .= '
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/katalog.css">
        ';

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('catalog-brand-' . $currentPage, 60, function () {
            $prems_ids = $this->prem_rep->getPremIds('brand');

            $prems = $this->repository->getPrems($prems_ids);

            $brands = $this->repository->getWithoutPrems(
                ['logo', 'title', 'content', 'alias', 'address'], true, ['category', 'brand'], $prems_ids);

            return view('catalog.brands')->with(['brands' => $brands, 'prems' => $prems, 'sidebar' => $this->sidebar])->render();
        });
        return $this->renderOutput();
    }

    public function getSeo($url)
    {
        $this->seo = Cache::remember('seo-' . $url, 24 * 60, function () use ($url) {
            return $this->seo_rep->getSeo($url);
        });
    }
}
