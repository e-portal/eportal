<?php

namespace Fresh\Estet\Http\Controllers;

use Fresh\Estet\Repositories\AdvertisingRepository;
use Fresh\Estet\Repositories\ArticlesRepository;
use Fresh\Estet\Repositories\SeoRepository;
use Fresh\Estet\Repositories\Static_pageRepository;
use Cache;

class Static_pageController extends MainController
{
    protected $repository;
    protected $seo_rep;

    public function __construct(
        ArticlesRepository $a_rep,
        Static_pageRepository $repository,
        SeoRepository $seo_rep,
        AdvertisingRepository $adv
    )
    {
        parent::__construct($a_rep, $adv);
        Cache::flush();
        $this->repository = $repository;
        $this->seo_rep = $seo_rep;
    }

    public function contacts()
    {
        $name = 'contacts';
        return $this->cacheHandler($name);
    }

    public function about()
    {
        $name = 'about';
        return $this->cacheHandler($name);
    }
    
    public function advertising()
    {
        $name = 'advertising';
        return $this->cacheHandler($name);
    }
    
    public function conditions()
    {
        $name = 'conditions';
        return $this->cacheHandler($name);
    }
    
    public function partnership()
    {
        $name = 'partnership';
        return $this->cacheHandler($name);
    }


    public function getFooter($name)
    {
        if (session()->has('doc')) {
            $this->footer = Cache::remember('footer-doc-' . $name, 24 * 60, function () {
                $adv = $this->adv_rep->getFooter('doc');
                return view('layouts.footer')->with(['adv' => $adv])->render();
            });
        } else {
            $this->footer = Cache::remember('footer-patient-' . $name, 24 * 60, function () {
                $adv = $this->adv_rep->getFooter('patient');
                return view('layouts.footer')->with(['adv' => $adv])->render();
            });
        }
    }

    /**
     * @param $name
     * @return view
     */
    public function cacheHandler($name)
    {
        $this->css = '
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/stati-vnutrennaya.css">
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/stati-vnutrennaya-media.css">
            ';
        $this->getSidebar(session()->has('doc'));
        $page = Cache::remember($name, 24 * 60, function () use ($name) {
            $model = $this->repository->get(['title', 'seo', 'text'], false, false, ['own', $name]);
            $model = $model->first();
            $model->seo = $this->repository->convertSeo($model->seo);
            return $model;
        });

        $this->seo = $page->seo;
//        dd($this->seo);
        $this->seo->og_image = asset('/estet/img') . '/' . $name . '.png';

        $this->content = view('static_pages.' . $name)->with([$name => $page, 'sidebar' => $this->sidebar])->render();
        $this->getFooter($name);
        return $this->renderOutput();
    }
}
