<section id="section-1" class="horoscope">
    <div class="left-title left-title-planshet">
        <div class="line-container text-vertical">
            <div class="vertical-line"></div>
            <h2>Карта сайта</h2>
        </div>
    </div>
    <div class="content">
        <div class="main-content">
            <div class="content-center">
                <div class="block">
                    <h3><a href="{{ route('main') }}">Главная</a></h3>
                    <ul>
                        <li><a href="{{ route('horoscope') }}">Гороскоп</a></li>
                        <li><a href="{{ route('search') }}">Поиск</a></li>
                        <li><a href="{{ route('about') }}">О нас</a></li>
                        <li><a href="{{ route('conditions') }}">Пользовательское соглашение</a></li>
                        <li><a href="{{ route('contacts') }}">Контакты</a></li>
                        <li><a href="{{ route('partnership') }}">Партнерство</a></li>
                        <li><a href="{{ route('advertising') }}">Реклама</a></li>
                    </ul>
                </div>
                <h2>Пациентам</h2>
                @if(!empty($vars['cats']))
                    @foreach($vars['cats'] as $cat)
                        @if('patient' === $cat->own)
                            <div class="block">
                                <h3><a href="{{ route('article_cat', $cat->alias) }}">{{ $cat->name }}</a></h3>
                                @if(!empty($vars['p_articles']))
                                    <ul>
                                        @foreach($vars['p_articles'] as $article)
                                            @if ($cat->id != $article->category_id)
                                                @continue
                                            @endif
                                            <li>
                                                <a href="{{ route('articles', $article->alias) }}">{{ $article->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endif
                <h2>Врачам</h2>
                @if(!empty($vars['cats']))
                    @foreach($vars['cats'] as $cat)
                        @if('docs' === $cat->own)
                            <div class="block">
                                <h3><a href="{{ route('docs_cat', $cat->alias) }}">{{ $cat->name }}</a></h3>
                                @if(!empty($vars['d_articles']))
                                    <ul>
                                        @foreach($vars['d_articles'] as $article)
                                            @if ($cat->id != $article->category_id)
                                                @continue
                                            @endif
                                            <li>
                                                <a href="{{ route('doctors', $article->alias) }}">{{ $article->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endif
                <h2>Блог</h2>
                @if(!empty($vars['blog_cats']))
                    @foreach($vars['blog_cats'] as $cat)
                        <div class="block">
                            <h3><a href="{{ route('blogs_cat', $cat->alias) }}">{{ $cat->name }}</a></h3>
                            @if(!empty($vars['blogs']))
                                <ul>
                                    @foreach($vars['blogs'] as $article)
                                        @if ($cat->id != $article->category_id)
                                            @continue
                                        @endif
                                        <li>
                                            <a href="{{ route('blogs', $article->alias) }}">{{ $article->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                @endif
                <h2>Каталог</h2>
                @if(!empty($vars['docs']))
                    <div class="block">
                        <h3><a href="{{ route('docs') }}">Врачи</a></h3>
                        <ul>
                            @foreach($vars['docs'] as $article)
                                <li>
                                    <a href="{{ route('docs', $article->alias) }}">
                                        {{ $article->lastname.' '. $article->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(!empty($vars['establishments']))
                    @foreach($vars['est_cats'] as $cat)
                        <div class="block">
                            <h3><a href="{{  route($cat.'s') }}">{{ trans('ru.'.$cat) }}</a></h3>
                            @if(!empty($vars['establishments']))
                                <ul>
                                    @foreach($vars['establishments'] as $article)
                                        @if ($cat != $article->category)
                                            @continue
                                        @endif
                                        <li>
                                            <a href="{{ route($cat.'s', $article->alias) }}">{{ $article->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                @endif
                <h2>Мероприятия</h2>
                @if(!empty($vars['events']))
                    <div class="block">
                        @if(!empty($vars['events']))
                            <ul>
                                @foreach($vars['events'] as $article)
                                    <li>
                                        <a href="{{ route('events', $article->alias) }}">{{ $article->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        {!! $sidebar !!}
    </div>
</section>

{{--
<div class="block">
    <h3><a href="{{ route('docs_cat', $cat->alias) }}">{{ $cat->name }}</a></h3>
    @if(!empty($vars['d_articles']))
        <ul>
            @foreach($vars['d_articles'] as $article)
                @if ($cat->id != $article->category_id)
                    @continue
                @endif
                <li><a href="{{ route('doctors', $article->alias) }}">{{ $article->title }}</a></li>
            @endforeach
        </ul>
    @endif
</div>--}}


{{--
<div class="row bg-success">
    <div class="row"><h2><a href="{{ route('main') }}">Главная</a></h2></div>
    <div class="row"><h3><a href="{{ route('horoscope') }}">Гороскоп</a></h3>
        <hr>
    </div>
    <div class="row"><h3><a href="{{ route('search') }}">Поиск</a></h3>
        <hr>
    </div>
    <hr>
    <div class="row bg-warning">
        @if(!empty($vars['cats']))
            @foreach($vars['cats'] as $cat)
                <div class="row">
                    @if('patient' === $cat->own)
                        <h3><a href="{{ route('article_cat', $cat->alias) }}">{{ $cat->name }}</a></h3>
                        @if(!empty($vars['p_articles']))
                            <ul>
                                @foreach($vars['p_articles'] as $article)
                                    @if ($cat->id != $article->category_id)
                                        @continue
                                    @endif
                                    <li><a href="{{ route('articles', $article->alias) }}">{{ $article->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @else
                        <h3><a href="{{ route('docs_cat', $cat->alias) }}">{{ $cat->name }}</a></h3>
                        @if(!empty($vars['d_articles']))
                            <ul>
                                @foreach($vars['d_articles'] as $article)
                                    @if ($cat->id != $article->category_id)
                                        @continue
                                    @endif
                                    <li><a href="{{ route('doctors', $article->alias) }}">{{ $article->title }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </div>
            @endforeach
        @endif
    </div>
    <hr>
    --}}
{{--Blog--}}{{--

    <div class="row bg-warning">
        <div class="row"><h2><a href="{{ route('blogs') }}">Блог</a></h2></div>
        @if(!empty($vars['blog_cats']))
            @foreach($vars['blog_cats'] as $cat)
                <div class="row">
                    <h3><a href="{{ route('blogs_cat', $cat->alias) }}">{{ $cat->name }}</a></h3>
                    @if(!empty($vars['blogs']))
                        <ul>
                            @foreach($vars['blogs'] as $blog)
                                @if ($cat->id != $blog->category_id)
                                    @continue
                                @endif
                                <li><a href="{{ route('blogs', $blog->alias) }}">{{ $blog->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
    --}}
{{--Blog--}}{{--

    <hr>
    --}}
{{--Catalog--}}{{--

    <div class="row bg-warning">
        <div class="row"><h2>Каталог</h2></div>
        <div class="row"><h3><a href="{{ route('docs') }}">Врачи</a></h3></div>
        @if(!empty($vars['docs']))
            <ul>
                @foreach($vars['docs'] as $doc)
                    <div class="row">
                        <li><a href="{{ route('docs', $doc->alias) }}">{{ $doc->lastname.' '. $doc->name }}</a></li>
                    </div>
                @endforeach
            </ul>
        @endif
        @if(!empty($vars['establishments']))
            @foreach($vars['est_cats'] as $cat)
                <ul>
                    <div class="row"><h3><a href="{{ route($cat.'s') }}">{{ trans('ru.'.$cat) }}</a></h3></div>
                    @foreach($vars['establishments'] as $establishment)
                        @if($cat !== $establishment->category)
                            @continue
                        @endif
                        <div class="row">
                            <li><a href="{{ route($cat.'s', $establishment->alias) }}">{{ $establishment->title }}</a>
                            </li>
                        </div>
                    @endforeach
                </ul>
            @endforeach
        @endif
    </div>
    --}}
{{--Catalog--}}{{--

    <hr>
    --}}
{{--Events--}}{{--

    <div class="row bg-warning">
        <div class="row"><h2><a href="{{ route('events') }}">Мероприятия</a></h2></div>
        @if(!empty($vars['event_cats']))
            @foreach($vars['event_cats'] as $cat)
                <div class="row">
                    <h3>{{ $cat->name }}</h3>
                    @if(!empty($vars['events']))
                        <ul>
                            @foreach($vars['events'] as $event)
                                @if ($cat->id != $event->cat_id)
                                    @continue
                                @endif
                                <li><a href="{{ route('events', $event->alias) }}">{{ $event->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
    --}}
{{--Events--}}{{--

</div>--}}
