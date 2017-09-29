@if(!empty($articles))
    <!--section 1-->
    <section id="section-1" class="last-articles">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Последние статьи</h2>
            </div>
        </div>
        <div class="content">
            <!--slider & ad-->
            <div class="slider-wrap">
                <div class="slider">
                    @foreach($articles['lasts'] as $article)
                        @if($loop->iteration > 3)
                            @continue
                        @endif
                        <article>
                            <div class="slide-left">
                                <a class="link-img" href="{{ route('doctors_art', $article->alias) }}"
                                   rel="nofollow">
                                    <img src="{{ asset('/images/article/middle').'/'.$article->path }}"
                                         alt="{{ $article->alt }}"
                                         title="{{ $article->img_title }}"></a>
                            </div>
                            <div class="slide-right">
                                <div class="slide-right_top">
                                    <div class="title-time">
                                        <a href="{{ route('docs_cat', $article->cat_alias) }}">{{ $article->name }}</a>
                                        <time>
                                            @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                            {{ $article->created }}
                                        </time>
                                    </div>
                                    <a href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                                        <h3>{{ str_limit($article->title, 72) }}</h3></a>
                                    <p>{{ str_limit(strip_tags($article->content), 312) }}</p>
                                </div>
                                <div class="slide-right_bot">
                                    <a class="btn-blue" href="{{ route('doctors_art',$article->alias) }}">Подробнее</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <aside class="ad">
                    {!! $advertising['main_1'] ?? '<img src="'. asset('estet') .'/bannera/270x450.png" >' !!}
                </aside>
            </div>
            <!--articles-gray-->
            <div class="articles-horizontal">
                @foreach($articles['lasts'] as $article)
                    @if($loop->iteration < 4)
                        @continue
                    @endif
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}" alt="{{ $article->alt }}"
                                 title="{{ $article->img_title }}">
                        </a>
                        <div class="title-time">
                            <a href="{{ route('docs_cat', $article->cat_alias) }}">{{ $article->name }}</a>
                            <time>
                                @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                {{ $article->created }}
                            </time>
                        </div>
                        <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                            <h3>{{ str_limit($article->title, 64) }}</h3>
                        </a>
                    </article>
                    @if(!$loop->last)
                        <div class="line-vertical"></div>
                    @endif
                @endforeach
            </div>
        </div>
        <!--section 1-->
    </section>
    <!--section 2-->
    <section id="section-2" class="most-popular">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Самое популярное</h2>
            </div>
        </div>
        <div class="content articles-divisions">
            <div class="article-big">
                <article>
                    <a class="link-img" href="{{ route('doctors_art', $articles['popular'][0]->alias) }}"
                       rel="nofollow">
                        <img src="{{ asset('/images/article/middle').'/'.$articles['popular'][0]->path }}"
                             alt="{{ $articles['popular'][0]->alt }}" title="{{ $articles['popular'][0]->img_title }}">
                        <div class="views">{{ $articles['popular'][0]->view }}</div>
                    </a>
                    <div class="title-time">
                        <time>
                            @if(strlen($articles['popular'][0]->created) < 6) <i class="icons icon-clock"></i> @endif
                            {{ $articles['popular'][0]->created }}
                        </time>
                    </div>
                    <a class="link-title" href="{{ route('doctors_art', $articles['popular'][0]->alias) }}">
                        <h3>{{ str_limit($articles['popular'][0]->title, 72) }}</h3>
                    </a>
                </article>
            </div>
            <div class="articles-vertical">
                @foreach($articles['popular'] as $article)
                    @if($loop->first)
                        @continue
                    @endif
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}" alt="{{ $article->alt }}"
                                 title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!--section 2-->
    <!--AD-->
    <section class="section-useful section-clos">
        <div class="useful">
            {!! $advertising['main_2'] ?? '<img src="'. asset('estet') .'/bannera/662x230.png" >' !!}
        </div>
    </section>
    <!--AD-->
    <!--section 3-->
    <section id="section-3" class="video">
        <div class="left-title">
            <div class="line-container">

                <div class="vertical-line"></div>
                <h2>Видео</h2>
            </div>
        </div>
        <div class="content">
            <div class="articles-horizontal">
                @foreach($articles['video'] as $video)
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $video->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$video->path }}" alt="{{ $video->alt }}"
                                 title="{{ $video->img_title }}">
                            <div class="views">{{ $video->view }}</div>
                        </a>
                        <div class="title-time">
                            <time>
                                {{ $video->created }}
                            </time>
                            <div class="horizontal-line"></div>
                        </div>
                        <a class="link-title" href="{{ route('doctors_art', $video->alias) }}">
                            <h3>{{ str_limit($video->title, 64) }}</h3>
                        </a>
                    </article>
                    @if(!$loop->last)
                        <div class="line-vertical"></div>
                    @endif
                @endforeach
            </div>
            <div class="button-block">
                <div class="button-line"></div>
                <a href="{{ route('docs_cat', $articles['video'][0]->cat_alias) }}">Перейти к разделу</a>
            </div>
        </div>
    </section>
    <!--section 3-->
    <!--section 4-->
    <section id="section-4" class="interesting-facts">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Эксперты</h2>
            </div>
        </div>
        <div class="content">
            <div class="articles-vertical">
                @foreach($articles['experts'] as $article)
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}" alt="{{ $article->alt }}"
                                 title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="aside-block">
                <div class="line-container">
                    <div class="vertical-line"></div>
                    <h2>Подписка</h2>
                </div>
                @include('layouts.subscribe')
            </div>
        </div>
    </section>
    <!--section 4-->
    <!--section 5-->
    <section id="section-5" class="cosmetology-food">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Косметология</h2>
            </div>
        </div>
        <div class="content articles-divisions">
            <div class="article-big">
                <article>
                    <a class="link-img" href="{{ route('doctors_art', $articles['cosmetology'][0]->alias) }}"
                       rel="nofollow">
                        <img src="{{ asset('/images/article/middle').'/'.$articles['cosmetology'][0]->path }}"
                             alt="{{ $articles['cosmetology'][0]->alt }}"
                             title="{{ $articles['cosmetology'][0]->img_title }}">
                        <div class="views">{{ $articles['cosmetology'][0]->view }}</div>
                    </a>
                    <div class="title-time">
                        <time>
                            @if(strlen($articles['cosmetology'][0]->created) < 6) <i
                                    class="icons icon-clock"></i> @endif
                            {{ $articles['cosmetology'][0]->created }}
                        </time>
                    </div>
                    <a class="link-title" href="{{ route('doctors_art', $articles['cosmetology'][0]->alias) }}">
                        <h3>{{ str_limit($articles['cosmetology'][0]->title, 72) }}</h3>
                    </a>
                </article>
            </div>
            <div class="articles-vertical">
                @foreach($articles['cosmetology'] as $article)
                    @if($loop->first)
                        @continue
                    @endif
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}" alt="{{ $article->alt }}"
                                 title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            </div>
            <div class="button-block">
                <div class="button-line"></div>
                <a href="{{ route('docs_cat', $articles['cosmetology'][0]->cat_alias) }}">Перейти к разделу</a>
            </div>
        </div>
    </section>
    <!--section 5-->
    <!--section 6-->
    <section id="section-6" class="beauty-health">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Мероприятия</h2>
            </div>
        </div>
        <div class="content">
            <div class="articles-horizontal">
                @foreach($articles['events'] as $article)
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/event/small').'/'.$article->logo->path }}"
                                 alt="{{ $article->logo->alt }}"
                                 title="{{ $article->logo->title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                    @if(!$loop->last)
                        <div class="line-vertical"></div>
                    @endif
                @endforeach
            </div>
            <div class="button-block">
                <div class="button-line"></div>
                <a href="{{ route('events') }}">Перейти к разделу</a>
            </div>
        </div>
    </section>
    <!--section 6-->
    <!--section 6-1 -->
    <section id="section-6-1" class="blog-doctor ">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Блог</h2>
            </div>
        </div>
        <div class="content ">
            <div class="articles-divisions">
            @if(!empty($articles['blogs']))
                @foreach($articles['blogs'] as $blog)
                    <article>
                        <a class="link-img" href="{{ route('blogs', $blog->alias) }}" rel="nofollow">
                            <img title="{{ $blog->blog_img->title }}" alt="{{ $blog->blog_img->alt }}"
                                 src="{{ asset('/images/blog/middle') . '/' . $blog->blog_img->path }}">
                            <div class="views">{{ $blog->view }}</div>
                        </a>
                        <div>

                            <div class="title-time">
                                <time>
                                    @if(strlen($blog->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $blog->created }}
                                </time>
                                <p>{{ $blog->category->name }}</p>
                            </div>
                            <a class="link-title" href="{{ route('blogs', $blog->alias) }}">
                                <h3>{{ str_limit($blog->title, 64) }}</h3>
                            </a>
                            <div class="blog-read-more">
                                <div class="author">
                                    <i class="icon-men"></i>
                                    <p>{{ $blog->person->person->lastname . ' ' . $blog->person->person->name }}</p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            @endif
            </div>
            <div class="button-block">
                <div class="button-line"></div>
            <a href="{{ route('blogs') }}">Перейти к разделу</a>
            </div>
        </div>

    </section>
    <!--section 6-1 -->
    <!--AD-->
    <section class="section-useful desser">
        <div class="useful">
            {!! $advertising['main_2'] ?? '<img src="'. asset('estet') .'/bannera/662x230.png" >' !!}
        </div>
    </section>
    <!--AD-->
    <!--section 7-->
    <section id="section-7" class="medicine-treatment treatment-doctor">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Дерматология</h2>
            </div>
        </div>
        <div class="content articles-divisions">
            <div class="article-big">
                <article>
                    <a class="link-img" href="{{ route('doctors_art', $articles['dermatology'][0]->alias) }}"
                       rel="nofollow">
                        <img src="{{ asset('/images/article/middle').'/'.$articles['dermatology'][0]->path }}"
                             alt="{{ $articles['dermatology'][0]->alt }}"
                             title="{{ $articles['dermatology'][0]->img_title }}">
                        <div class="views">{{ $articles['dermatology'][0]->view }}</div>
                    </a>
                    <div class="title-time">
                        <time>
                            @if(strlen($articles['dermatology'][0]->created) < 6) <i
                                    class="icons icon-clock"></i> @endif
                            {{ $articles['dermatology'][0]->created }}
                        </time>
                    </div>
                    <a class="link-title" href="{{ route('doctors_art', $articles['dermatology'][0]->alias) }}">
                        <h3>{{ str_limit($articles['dermatology'][0]->title, 72) }}</h3>
                    </a>
                </article>
            </div>
            <div class="articles-vertical">
                @foreach($articles['dermatology'] as $article)
                    @if($loop->first)
                        @continue
                    @endif
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}" alt="{{ $article->alt }}"
                                 title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            </div>
            <div class="button-block">
                <div class="button-line"></div>
                <a href="{{ route('docs_cat', $articles['dermatology'][0]->cat_alias) }}">Перейти к разделу</a>
            </div>
        </div>
    </section>
    <!--section 7-->
    <!--section 8-->
    <section id="section-8" class="helpful-tips">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Практика</h2>
            </div>
        </div>
        <div class="content">
            <div class="articles-horizontal">
                @foreach($articles['practic'] as $article)
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}"
                                 alt="{{ $article->alt }}" title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                    @if(!$loop->last)
                        <div class="line-vertical"></div>
                    @endif
                @endforeach
            </div>
            <div class="button-block">
                <div class="button-line"></div>
                <a href="{{ route('docs_cat', $articles['practic'][0]->cat_alias) }}">Перейти к разделу</a>
            </div>
        </div>
    </section>
    <!--section 8-->
    <!--section 9-->
    <section id="section-9" class="stomatology">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Пластическая хирургия</h2>
            </div>
        </div>
        <div class="content articles-divisions">
            <div class="article-big">
                <article>
                    <a class="link-img" href="{{ route('doctors_art', $articles['plastic'][0]->alias) }}"
                       rel="nofollow">
                        <img src="{{ asset('/images/article/middle').'/'.$articles['plastic'][0]->path }}"
                             alt="{{ $articles['plastic'][0]->alt }}"
                             title="{{ $articles['plastic'][0]->img_title }}">
                        <div class="views">{{ $articles['plastic'][0]->view }}</div>
                    </a>
                    <div class="title-time">
                        <time>
                            @if(strlen($articles['plastic'][0]->created) < 6) <i
                                    class="icons icon-clock"></i> @endif
                            {{ $articles['plastic'][0]->created }}
                        </time>
                    </div>
                    <a class="link-title" href="{{ route('doctors_art', $articles['plastic'][0]->alias) }}">
                        <h3>{{ str_limit($articles['plastic'][0]->title, 72) }}</h3>
                    </a>
                </article>
            </div>
            <div class="articles-vertical">
                @foreach($articles['plastic'] as $article)
                    @if($loop->first)
                        @continue
                    @endif
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}" alt="{{ $article->alt }}"
                                 title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            </div>
            <div class="button-block">
                <div class="button-line"></div>
                <a href="{{ route('docs_cat', $articles['plastic'][0]->cat_alias) }}">Перейти к разделу</a>
            </div>
        </div>
    </section>
    <!--section 9-->
    <!--section 10-->
    <section id="section-10" class="psychology endocrinology">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Эндокринология</h2>
            </div>
        </div>
        <div class="content ">
            <div class="articles-horizontal">
                @foreach($articles['endocrinology'] as $article)
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}"
                                 alt="{{ $article->alt }}" title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                    @if(!$loop->last)
                        <div class="line-vertical"></div>
                    @endif
                @endforeach
            </div>
            <div class="button-block">
                <div class="button-line"></div>
                <a href="{{ route('docs_cat', $articles['endocrinology'][0]->cat_alias) }}">Перейти к разделу</a>
            </div>
        </div>
    </section>
    <!--section 10-->
    <!--AD-->
    <section id="section-ad" class="section-useful">
        <div class="useful">
            {!! $advertising['main_3'] ?? '<img src="'. asset('estet') .'/bannera/662x230.png" >' !!}
        </div>
    </section>
    <!--AD-->
    <!--section 11-->
    <section id="section-11" class="stomatology  stomatology-doctor">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Стоматология</h2>
            </div>
        </div>
        <div class="content articles-divisions">
            <div class="article-big">
                <article>
                    <a class="link-img" href="{{ route('doctors_art', $articles['stomatology'][0]->alias) }}"
                       rel="nofollow">
                        <img src="{{ asset('/images/article/middle').'/'.$articles['stomatology'][0]->path }}"
                             alt="{{ $articles['stomatology'][0]->alt }}"
                             title="{{ $articles['stomatology'][0]->img_title }}">
                        <div class="views">{{ $articles['stomatology'][0]->view }}</div>
                    </a>
                    <div class="title-time">
                        <time>
                            @if(strlen($articles['stomatology'][0]->created) < 6) <i
                                    class="icons icon-clock"></i> @endif
                            {{ $articles['stomatology'][0]->created }}
                        </time>
                    </div>
                    <a class="link-title" href="{{ route('doctors_art', $articles['stomatology'][0]->alias) }}">
                        <h3>{{ str_limit($articles['stomatology'][0]->title, 72) }}</h3>
                    </a>
                </article>
            </div>
            <div class="articles-vertical">
                @foreach($articles['stomatology'] as $article)
                    @if($loop->first)
                        @continue
                    @endif
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}" alt="{{ $article->alt }}"
                                 title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            </div>
            <div class="button-block">
                <div class="button-line"></div>
                <a href="{{ route('docs_cat', $articles['stomatology'][0]->cat_alias) }}">Перейти к разделу</a>
            </div>
        </div>
    </section>
    <!--section 11-->

    <!-- section 11-1 -->
    <section id="section-11-1" class="venerology">
        <section id="section-1-1">
            <div class="left-title">
                <div class="line-container">
                    <div class="vertical-line"></div>
                    <h2>Венерология</h2>
                </div>
            </div>
            <div class="content articles-divisions">
                <div class="articles-vertical">
                    @if(!empty($articles['venerology'][0]))
                        @foreach($articles['venerology'] as $article)
                            <article>
                                <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                                    <img src="{{ asset('/images/article/small').'/'.$article->path }}"
                                         alt="{{ $article->alt }}"
                                         title="{{ $article->img_title }}">
                                    <div class="views">{{ $article->view }}</div>
                                </a>
                                <div>
                                    <div class="title-time">
                                        <time>
                                            @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                            {{ $article->created }}
                                        </time>
                                    </div>
                                    <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                        <h3>{{ str_limit($article->title, 64) }}</h3>
                                    </a>
                                </div>
                            </article>
                            @if(!$loop->last)
                <hr>
                            @endif
                        @endforeach
                        <div class="button-block">
                            <div class="button-line"></div>
                            <a href="{{ route('docs_cat', $articles['venerology'][0]->cat_alias) }}">Перейти к
                                разделу</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section id="section-2-2">
            <div class="left-title">
                <div class="line-container">
                    <div class="vertical-line"></div>
                    <h2>Урология</h2>
                </div>
            </div>
            <div class="content articles-divisions">
                <div class="articles-vertical">
                    @if(!empty($articles['urology'][0]))
                        @foreach($articles['urology'] as $article)
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}"
                                 alt="{{ $article->alt }}"
                                 title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                            @if(!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                        <div class="button-block">
                            <div class="button-line"></div>
                            <a href="{{ route('docs_cat', $articles['urology'][0]->cat_alias) }}">Перейти к разделу</a>
                </div>
                    @endif
                </div>
            </div>
    </section>
    </section>
    <!-- section 11-1 -->
    <!-- section 11-1 -->

    <!--section 12-->
    <section id="section-12" class="psychology">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Трихология</h2>
            </div>
        </div>
        <div class="content ">
            <div class="articles-horizontal">
                @foreach($articles['trihology'] as $article)
                    <article>
                        <a class="link-img" href="{{ route('doctors_art', $article->alias) }}" rel="nofollow">
                            <img src="{{ asset('/images/article/small').'/'.$article->path }}"
                                 alt="{{ $article->alt }}" title="{{ $article->img_title }}">
                            <div class="views">{{ $article->view }}</div>
                        </a>
                        <div>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </div>
                    </article>
                    @if(!$loop->last)
                        <div class="line-vertical"></div>
                    @endif
                @endforeach
            </div>
            <div class="button-block">
                <div class="button-line"></div>
                <a href="{{ route('docs_cat', $articles['trihology'][0]->cat_alias) }}">Перейти к разделу</a>
            </div>
        </div>
    </section>
    <!--section 12-->
@endif