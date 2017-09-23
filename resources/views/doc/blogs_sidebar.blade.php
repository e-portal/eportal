<aside class="aside">
    <div class="aside-block">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line line-purple"></div>
                <h2>Последние мероприятия</h2>
            </div>
        </div>
        <div class="content">
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
                            <a class="link-title" href="{{ route('events', $last->alias) }}">
                                <h3>{{ str_limit($last->title, 72) }}</h3>
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
                <div class="vertical-line line-purple"></div>
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
                            <a class="link-title" href="{{ route('blogs', $article->alias) }}">
                                <h3>{{ str_limit($article->title, 72) }}</h3>
                            </a>
                        </article>
                        @if(0 == $loop->index)
                            <hr> @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="aside-block">
        <div class="advertising">
            {!! $advertising['sidebar'] ?? '<img src="'. asset('estet') .'/bannera/200x325.png" >' !!}
        </div>
    </div>
    @include('layouts.horoscope.sidebar')
    <div class="aside-block">
        <div class="advertising">
            {!! $advertising['sidebar_2'] ?? '<img src="'. asset('estet') .'/bannera/200x325.png" >' !!}
        </div>
    </div>
    <div class="aside-block subscribe-block">
        @include('layouts.subscribe')
    </div>
</aside>