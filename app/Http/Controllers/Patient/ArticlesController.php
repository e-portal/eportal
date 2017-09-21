<?php
namespace Fresh\Estet\Http\Controllers\Patient;

use Fresh\Estet\Http\Controllers\Controller;
use Fresh\Estet\Repositories\AdvertisingRepository;
use Fresh\Estet\Repositories\CategoriesRepository;
use Fresh\Estet\Repositories\SeoRepository;
use Fresh\Estet\Repositories\TagsRepository;
use Menu;
use DB;
use Cache;
use Fresh\Estet\Repositories\ArticlesRepository;


class ArticlesController extends Controller
{
    protected $template = 'patient.index';
    protected $content = FALSE;
    protected $title;
    protected $vars;
    protected $sidebar = false;
    protected $footer;
    protected $a_rep;
    protected $adv_rep;
    protected $cat_rep;
    protected $tag_rep;
    protected $title_img;
    protected $seo_rep;
    protected $seo = false;
    protected $css = false;
    protected $js = false;

    public function __construct(
        ArticlesRepository $repository,
        AdvertisingRepository $adv,
        SeoRepository $seo_rep,
        TagsRepository $tags,
        CategoriesRepository $cat_rep
    )
    {
        Cache::flush();
        $this->a_rep = $repository;
        $this->adv_rep = $adv;
        $this->seo_rep = $seo_rep;
        $this->tag_rep = $tags;
        $this->cat_rep = $cat_rep;
    }

    public function index()
    {
        $this->content = Cache::remember('main', 60, function() {

            $articles = [
                'lasts' => $this->a_rep->getMain([['id', '<>', null]], 6, ['created_at', 'desc'], 'patient'),
                'popular' => $this->a_rep->getMain([['id', '<>', null]],4, ['view', 'desc'], 'patient'),
                'video' => $this->a_rep->getMain([['category_id', 20]],3, ['created_at', 'desc'], 'patient'),
                'facts' => $this->a_rep->getMain([['category_id', 17]], 20, ['created_at', 'desc'], 'patient'),
                'diet' => $this->a_rep->getMain([['category_id', 19]],4, ['created_at', 'desc'], 'patient'),
                'beauty' => $this->a_rep->getMain([['category_id', 14]],3, ['created_at', 'desc'], 'patient'),
                'medicine' => $this->a_rep->getMain([['category_id', 15]],4, ['created_at', 'desc'], 'patient'),
                'advice' => $this->a_rep->getMain([['category_id', 16]],3, ['created_at', 'desc'], 'patient'),
                'stomatology' => $this->a_rep->getMain([['category_id', 8]],4, ['created_at', 'desc'], 'patient'),
                'psychology' => $this->a_rep->getMain([['category_id', 18]],3, ['created_at', 'desc'], 'patient'),
            ];
            $advertising = $this->adv_rep->getMainPatient();
            return view('patient.content')
                ->with(['articles' => $articles, 'advertising' => $advertising])
                ->render();

        });
        $this->title = 'Главная';
        $this->seo = Cache::remember('seo_main', 24 * 60, function () {
            return $this->seo_rep->getSeo('/');
        });
        $this->css = '
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/patient.css">
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/patient-media.css">
            <link rel="stylesheet" type="text/css" href="' . asset('css') . '/jquery.mCustomScrollbar.min.css">
        ';
        $this->js = '
            <script src="' . asset('js') . '/libs/jquery.mCustomScrollbar.concat.min.js"></script>
            <script src="' . asset('js') . '/patient.js"></script>
            <script>
            $(\'#captcha\').click(function(e){
                $(".captcha").attr(\'src\',\'http://39.j2landing.com/captcha\');
            })

        </script>
        ';
        return $this->renderOutput();
    }

    public function show($article=null)
    {
        $this->js = '
            <script src="' . asset('js') . '/libs/jquery.mCustomScrollbar.concat.min.js"></script>
            <script src="' . asset('js') . '/patient.js"></script>
        ';
        if ($article) {
            $this->css = '
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/stati-vnutrennaya.css">
                <link rel="stylesheet" type="text/css" href="' . asset('css') . '/stati-vnutrennaya-media.css">
            ';

            $this->a_rep->displayed($article);

            $article = Cache::remember('patients_article-'.$article->id, 60, function () use ($article) {
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
                [['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['id', '<>', $article->id], ['own', 'patient'], ['category_id', $article->category_id]],
                false, ['image']
            );
            $this->getSidebar();
            $this->content = view('patient.article')
                ->with(['article' => $article, 'sidebar' => $this->sidebar, 'same' => $same])
                ->render();
            return $this->renderOutput();
        }
        return redirect()->route('main');
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

        $this->content = Cache::remember('articles_tags' . $tag->alias . $currentPage, 60, function () use ($tag) {
            $articles = $this->a_rep->getByTag($tag->id, 'patient');
            return view('patient.tags')
                ->with(['articles' => $articles, 'tag' => $tag, 'sidebar' => $this->sidebar])
                ->render();
        });

        return $this->renderOutput();
    }

    /**
     * @param $cat
     * @return $this
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

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->content = Cache::remember('articles_cats' . $cat->alias . $currentPage, 60, function () use ($cat) {
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'patient'], ['category_id', $cat->id] );
            $articles = $this->a_rep->get('*', 14, true, $where, ['created_at', 'desc'], ['image']);
            $this->getSidebar();
            return view('patient.cat')
                ->with(['articles' => $articles, 'sidebar' => $this->sidebar, 'cat' => $cat])
                ->render();
        });

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

        $nav = Cache::remember('patientMenu', 60,function() {
            $menu = $this->getMenu();
            return view('layouts.nav')->with('menu', $menu)->render();
        });
        $this->vars = array_add($this->vars, 'nav', $nav);


        if (!empty($this->footer)) {
            $footer = $this->footer;
        } else {
            $footer = Cache::remember('footer', 24*60, function () {
                $adv = $this->adv_rep->getFooter('patient');
                return view('layouts.footer')->with(['adv' => $adv])->render();
            });
        }
        $this->vars = array_add($this->vars, 'footer', $footer);

        if(false !== $this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }


        return view($this->template)->with($this->vars);
    }

    /**
     * @return mixed
     */
    public function getMenu() {
        $cats = DB::select('SELECT `name`, `alias` FROM `patientmenuview`');

        return Menu::make('menu', function($menu) use ($cats) {
            $menu->add('Последние', ['route'=>['articles_last']]);
            foreach ($cats as $cat) {
                if (('Видео' == $cat->name) || ('Видео отзывы' == $cat->name) || ('Интервью' == $cat->name)) {
                    continue;
                }
                $menu->add($cat->name, ['route'=>['article_cat', $cat->alias]]);
            }

        });
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

        $this->content = Cache::remember('articles_last-' . $currentPage, 60, function () {
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'patient']);
            $articles = $this->a_rep->get(
                '*', 14, true, $where, ['created_at', 'desc'], ['image']);

            $cat = new \stdClass();
            $cat->name = 'Последние новости';
            $this->getSidebar();
            return view('patient.cat')
                ->with(['articles' => $articles, 'cat' => $cat, 'sidebar' => $this->sidebar])
                ->render();
        });


        $this->seo = Cache::remember('seo_lasts', 24 * 60, function () {
            return $this->seo_rep->getSeo('poslednie-novosti');
        });
        return $this->renderOutput();
    }

    /**
     * @return bool
     */
    public function getSidebar()
    {
        $this->sidebar = Cache::remember('patientSidebar', 60, function () {
//                Last 2 publications
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'patient']);
            $lasts = $this->a_rep->getLast(['title', 'alias', 'created_at'], $where, 2, ['created_at', 'desc']);

            //          most displayed
            $where = array(['approved', true], ['created_at', '<=', DB::raw('NOW()')], ['own', 'patient']);
            $articles = $this->a_rep->mostDisplayed(['title', 'alias', 'created_at'], $where, 2, ['view', 'desc']);

            $advertising = $this->adv_rep->getSidebar('patient');
            return view('patient.sidebar')
                ->with(['lasts' => $lasts, 'articles' => $articles, 'advertising' => $advertising])
                ->render();
        });
        return true;
    }
}
