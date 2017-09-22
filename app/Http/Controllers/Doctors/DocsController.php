<?php

namespace Fresh\Estet\Http\Controllers\Doctors;

use Fresh\Estet\Repositories\AdvertisingRepository;
use Fresh\Estet\Repositories\ArticlesRepository;
use Fresh\Estet\Http\Controllers\Controller;
use Fresh\Estet\Repositories\BlogsRepository;
use Fresh\Estet\Repositories\EventsRepository;
use Fresh\Estet\Event;
use Fresh\Estet\Repositories\SeoRepository;
use Menu;
use DB;
use Cache;

class DocsController extends Controller
{
    protected $template = 'doc.index';
    protected $content = FALSE;
    protected $title;
    protected $vars;
    protected $sidebar = false;
    protected $a_rep;
    protected $adv_rep;
    protected $blog_rep;
    protected $title_img;
    protected $seo_rep;
    protected $seo = false;
    protected $css = false;
    protected $js = false;

    /**
     * DocsController constructor.
     * @param ArticlesRepository $repository
     */
    public function __construct(
        ArticlesRepository $repository,
        AdvertisingRepository $adv,
        SeoRepository $seo_rep,
        BlogsRepository $blog
    )
    {
        $this->a_rep = $repository;
        $this->adv_rep = $adv;
        $this->seo_rep = $seo_rep;
        $this->blog_rep = $blog;
    }

    public function showMain()
    {
        $this->content = Cache::remember('docsArticles', 60, function () {
            $events = new EventsRepository(new Event());
            $articles = [
                'lasts' => $this->a_rep->getMain([['id', '<>', null]], 6, ['created_at', 'desc'], 'docs'),
                'popular' => $this->a_rep->getMain([['id', '<>', null]], 4, ['view', 'desc'], 'docs'),
                'video' => $this->a_rep->getMain([['category_id', 20]], 3, ['created_at', 'desc'], 'docs'),
                'experts' => $this->a_rep->getMain([['category_id', 2]], 20, ['created_at', 'desc'], 'docs'),
                'cosmetology' => $this->a_rep->getMain([['category_id', 5]], 4, ['created_at', 'desc'], 'docs'),
                'dermatology' => $this->a_rep->getMain([['category_id', 4]], 4, ['created_at', 'desc'], 'docs'),
                'practic' => $this->a_rep->getMain([['category_id', 1]], 3, ['created_at', 'desc'], 'docs'),
                'plastic' => $this->a_rep->getMain([['category_id', 6]], 4, ['created_at', 'desc'], 'docs'),
                'endocrinology' => $this->a_rep->getMain([['category_id', 12]], 3, ['created_at', 'desc'], 'docs'),
                'stomatology' => $this->a_rep->getMain([['category_id', 8]], 4, ['created_at', 'desc'], 'docs'),
                'venerology' => $this->a_rep->getMain([['category_id', 9]], 3, ['created_at', 'desc'], 'docs'),
                'urology' => $this->a_rep->getMain([['category_id', 11]], 3, ['created_at', 'desc'], 'docs'),
                'trihology' => $this->a_rep->getMain([['category_id', 7]], 3, ['created_at', 'desc'], 'docs'),
                'events' => $events->get(['id', 'alias', 'title', 'created_at', 'view'], 3, false, [['approved', 1]], ['created_at', 'desc'], ['logo']),
                'blogs' => $this->blog_rep->get(['id', 'alias', 'title', 'created_at', 'view'], 4, false, [['approved', 1]], ['created_at', 'desc'], ['blog_img', 'category', 'person'], true),
            ];

            $advertising = $this->adv_rep->getMainDocs();
            return view('doc.content')
                ->with(['articles' => $articles, 'advertising' => $advertising])
                ->render();
        });
        $this->title = 'Профессионалам';
        $this->seo = Cache::remember('seo_docs', 24 * 60, function () {
            return $this->seo_rep->getSeo('doctor/statyi');
        });

        $this->css = '
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/patient.css">
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/patient-media.css">
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/jquery.mCustomScrollbar.min.css">
        ';
        $this->js = '
            <script src="' . asset('js') . '/libs/jquery.mCustomScrollbar.concat.min.js"></script>
            <script src="' . asset('js') . '/patient.js"></script>
        ';


        return $this->renderOutput();
    }

    /**
     * @param null $article
     * @return DocsController
     */
    public function index($article = null)
    {
        Cache::flush();
        if ($article) {
            $this->css = '
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/stati-vnutrennaya.css">
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/stati-vnutrennaya-media.css">
            ';

            $this->a_rep->displayed($article);

            $article = Cache::remember('docs_article-' . $article->id, 60, function () use ($article) {
                if (!empty($article->seo)) {
                    $article->seo = $this->a_rep->convertSeo($article->seo);
                } else {
                    $article->seo = new \stdClass();
                }
                $article->created = $this->a_rep->convertDate($article->created_at);
                $article->load('category');
                $article->load('tags');
                $article->load('comments');
                $article->load('image');
                $article->seo->og_image = asset('/images/article/main') . '/' . $article->image->path;
                return $article;
            });

            $this->seo = $article->seo ?? '<img src="' . asset('estet') . '/img/estet.png" >';

            $same = $this->a_rep->get(
                ['title', 'alias', 'created_at'], 3, false,
                [['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['id', '<>', $article->id], ['own', 'docs'], ['category_id', $article->category_id]],
                false, ['image']
            );
            $this->title = $article->title;

            $this->getSidebar();
            $this->content = view('doc.article')
                ->with(['article' => $article, 'sidebar' => $this->sidebar, 'same' => $same])
                ->render();
            return $this->renderOutput();
        }

        $this->content = Cache::remember('docsArticles', 60, function () {
            $events = new EventsRepository(new Event());
            $articles = [
                'lasts' => $this->a_rep->getMain([['id', '<>', null]], 6, ['created_at', 'desc'], 'docs'),
                'popular' => $this->a_rep->getMain([['id', '<>', null]],4, ['view', 'desc'], 'docs'),
                'video' => $this->a_rep->getMain([['category_id', 20]],3, ['created_at', 'desc'], 'docs'),
                'experts' => $this->a_rep->getMain([['category_id', 2]], 20, ['created_at', 'desc'], 'docs'),
                'cosmetology' => $this->a_rep->getMain([['category_id', 5]],4, ['created_at', 'desc'], 'docs'),
                'dermatology' => $this->a_rep->getMain([['category_id', 4]],4, ['created_at', 'desc'], 'docs'),
                'practic' => $this->a_rep->getMain([['category_id', 1]],3, ['created_at', 'desc'], 'docs'),
                'plastic' => $this->a_rep->getMain([['category_id', 6]],4, ['created_at', 'desc'], 'docs'),
                'endocrinology' => $this->a_rep->getMain([['category_id', 12]],3, ['created_at', 'desc'], 'docs'),
                'stomatology' => $this->a_rep->getMain([['category_id', 8]],4, ['created_at', 'desc'], 'docs'),
                'venerology' => $this->a_rep->getMain([['category_id', 9]],3, ['created_at', 'desc'], 'docs'),
                'urology' => $this->a_rep->getMain([['category_id', 11]],3, ['created_at', 'desc'], 'docs'),
                'trihology' => $this->a_rep->getMain([['category_id', 7]],3, ['created_at', 'desc'], 'docs'),
                'events' => $events->get(['id', 'alias', 'title', 'created_at', 'view'], 3, false, [['approved',1]], ['created_at', 'desc'], ['logo']),
                'blogs' => $this->blog_rep->get(['id', 'alias', 'title', 'created_at', 'view'], 4, false, [['approved', 1]], ['created_at', 'desc'], ['blog_img', 'category', 'person'], true),
            ];

            $advertising = $this->adv_rep->getMainDocs();
            return view('doc.content')
                ->with(['articles' => $articles, 'advertising' => $advertising])
                ->render();
        });
        $this->title = 'Профессионалам';
        $this->getSeo('doctor/statyi');

        $this->css = '
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/patient.css">
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/patient-media.css">
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/jquery.mCustomScrollbar.min.css">
        ';
        $this->js = '
            <script src="' . asset('js') . '/libs/jquery.mCustomScrollbar.concat.min.js"></script>
            <script src="' . asset('js') . '/patient.js"></script>
        ';


        return $this->renderOutput();
    }

    /**
     * @param $cat
     * @return DocsController
     */
    public function category($cat = null)
    {
        if (!$cat) {
            abort(404);
        }
        $this->css = '
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/statyi.css">
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/statyi-media.css">
            ';

        $this->getSidebar();

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('docs_cats' . $cat->alias . $currentPage, 60, function () use ($cat) {
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'docs'], ['category_id', $cat->id]);
            $articles = $this->a_rep->get('*', 14, true, $where, ['created_at', 'desc'], ['image']);

            $this->getSidebar();

            return view('doc.cat')
                ->with(['articles' => $articles, 'sidebar' => $this->sidebar, 'cat' => $cat])
                ->render();
        });
        $this->title = $cat->name;
        $this->getSeo('doctor/kategorii');
        $this->getSidebar();
        return $this->renderOutput();
    }

    /**
     * @return $this
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'seo', $this->seo);
        $this->vars = array_add($this->vars, 'css', $this->css);
        $this->vars = array_add($this->vars, 'js', $this->js);

        $this->title_img = true;
        $this->vars = array_add($this->vars, 'title_img', $this->title_img);

        $nav = Cache::remember('docsMenu', 60, function () {
            $menu = $this->getMenu();
            return view('layouts.nav')->with('menu', $menu)->render();
        });
        $this->vars = array_add($this->vars, 'nav', $nav);

        if (!empty($this->footer)) {
            $footer = $this->footer;
        } else {
            $footer = Cache::remember('docs_footer', 24 * 60, function () {
                $adv = $this->adv_rep->getFooter('doc');
                return view('layouts.footer')->with(['adv' => $adv])->render();
            });
        }
        $this->vars = array_add($this->vars, 'footer', $footer);



        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        return view($this->template)->with($this->vars);
    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        $cats = DB::select('SELECT `name`, `alias` FROM `docsmenuview`');

        return Menu::make('menu', function ($menu) use ($cats) {
            $menu->add('Последние', ['route' => ['docs_articles_last']]);
            foreach ($cats as $cat) {
                if ('Видео' == $cat->name) {
                    continue;
                }
                $menu->add($cat->name, ['route' => ['docs_cat', $cat->alias]]);
            }
        });
    }

    /**
     * Select crticles by tag
     * @param $tag
     * @return view result
     */
    public function tag($tag = null)
    {
        if (!$tag) {
            abort(404);
        }
        $this->css = '
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/statyi.css">
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/statyi-media.css">
            ';

        $this->getSidebar();

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $this->content = Cache::remember('docs_tags' . $tag->alias . $currentPage, 60, function () use ($tag) {
            $articles = $this->a_rep->getByTag($tag->id, 'docs');
            return view('doc.tags')
                ->with(['articles' => $articles, 'tag' => $tag, 'sidebar' => $this->sidebar])
                ->render();
        });

        $this->getSeo('doctor/teg');
        return $this->renderOutput();
    }

    /**
     * @return ArticlesController
     */
    public function lastArticles()
    {
        $this->css = '
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/statyi.css">
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/statyi-media.css">
            ';

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('docs_articles_last-' . $currentPage, 60, function () {
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'docs']);
            $articles = $this->a_rep->get('*', 14, true, $where, ['created_at', 'desc'], ['image']);

            $cat = new \stdClass();
            $cat->name = 'Последние новости';
            $this->getSidebar();

            return view('doc.cat')
                ->with(['articles' => $articles, 'cat' => $cat, 'sidebar' => $this->sidebar])
                ->render();
        });

        $this->seo = Cache::remember('seo_lasts', 24 * 60, function () {
            return $this->seo_rep->getSeo('poslednie-novosti');
        });
        $this->getSidebar();
        return $this->renderOutput();
    }

    /**
     * @return bool
     */
    public function getSidebar()
    {
        $this->sidebar = Cache::remember('docsArticleSidebar', 60, function () {
            //            Last 2 publications
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'docs']);
            $lasts = $this->a_rep->getLast(['title', 'alias', 'created_at'], $where, 2, ['created_at', 'desc']);
            //          most displayed
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'docs']);
            $articles = $this->a_rep->mostDisplayed(['title', 'alias', 'created_at'], $where, 2, ['view', 'asc']);

            $advertising = $this->adv_rep->getSidebar('doc');

            return view('doc.sidebar')
                ->with(['lasts' => $lasts, 'articles' => $articles, 'advertising' => $advertising])
                ->render();
        });
        return true;
    }

    /**
     * @param $url
     */
    public function getSeo($url)
    {
        $this->seo = Cache::remember('seo-' . $url, 24 * 60, function () use ($url) {
            return $this->seo_rep->getSeo($url);
        });
    }
}
