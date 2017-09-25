<?php

namespace Fresh\Estet\Http\Controllers;

use Cache;
use Fresh\Estet\Repositories\SitemapRepository;
use Fresh\Estet\Repositories\SeoRepository;
use Fresh\Estet\Seo;
use Fresh\Estet\User;

class SitemapController extends MainController
{
    protected $repository;
    protected $seo_rep;

    /**
     * @return bool
     */
    public function index()
    {
        Cache::flush();
        $this->repository = new SitemapRepository();

        $status = session()->has('doc') ? 'doc' : 'patient';

        $this->getSidebar(session()->has('doc'));

        $sitemap = Cache::store('file')->remember('sitemap_view-' . $status, 1430, function () {
            $vars = [
                'cats' => $this->repository->getCategories(),
                'p_articles' => $this->repository->getPatientArticles(),
                'd_articles' => $this->repository->getDocsArticles(),
                'blogs' => $this->repository->getBlogs(),
                'blog_cats' => $this->repository->getBlogCats(),
                'docs' => $this->repository->getDocs(),
                'establishments' => $this->repository->getEstablishments(),
                'est_cats' => ['clinic', 'distributor', 'brand'],
                'events' => $this->repository->getEvents(),
                'event_cats' => $this->repository->getEventCats(),
            ];
            \Log::info('Карта сайта обновлена: ' . date("d-m-Y H:i"));

            return $vars;
        });

        $this->title = 'Карта сайта';
        $this->seo_rep = new SeoRepository(new Seo());
        $this->seo = Cache::remember('site-map-seo', 24 * 60, function () {
            return $this->seo_rep->getSeo('karta-saita');
        });

        $this->content = view('sitemap.content')->with(['vars' => $sitemap, 'sidebar' => $this->sidebar])->render();
        return true;
    }

    /**
     * @return view
     */
    public function show()
    {
        $this->title = 'Sitemap';

        $this->index();
        $this->css = '
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/map-site.css">
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/map-site-media.css">
        ';

        $this->footer = Cache::remember('footer-sitemap', 24 * 60, function () {
            return view('layouts.footer')->render();
        });

        return $this->renderOutput();
    }
}
