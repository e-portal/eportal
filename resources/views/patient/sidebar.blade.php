<aside class="aside">
    <div class="aside-block">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Последние статьи</h2>
            </div>
        </div>
        <div class="content" content-aside-main>
            <div class="articles-vertical">
                @if($lasts)
                    @foreach($lasts as $last)
                        <article>
                            <div class="title-time">
                                <time>
                                    @if(strlen($last->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $last->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('articles', $last->alias) }}">
                                <h3>{{ str_limit($last->title, 64) }}</h3>
                            </a>
                        </article>
                        @if(0 == $loop->index)
                            <hr> @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="aside-block highly-block">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line"></div>
                <h2>Самое популярное</h2>
            </div>
        </div>
        <div class="content">
            <div class="articles-vertical">
                @if($articles)
                    @foreach($articles as $article)
                        <article>
                            <div class="title-time">
                                <time>
                                    @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $article->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('articles', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 64) }}</h3>
                            </a>
                        </article>
                        @if(0 == $loop->index)
                            <hr> @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @include('layouts.horoscope.sidebar')
    <div class="aside-block">
        <div class="advertising">
            {!! $advertising['sidebar'] ?? '<img src="'. asset('estet') .'/img/advertising.jpg" >' !!}
        </div>
    </div>
    <div class="aside-block">
        @include('layouts.subscribe')
    </div>
</aside>