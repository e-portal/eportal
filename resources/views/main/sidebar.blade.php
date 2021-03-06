<aside class="aside">
    <div class="aside-block aside-articles">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line @if(session()->has('doc')) line-purple @endif"></div>
                @if(session()->has('doc'))
                    <h2>Последние мероприятия</h2>
                @else
                    <h2>Последние статьи</h2>
                @endif
            </div>
        </div>
        <div class="content">
            <div class="articles-vertical">
                @if($lasts)
                    @foreach($lasts as $last)
                        <article>
                            <div class="title-time">
                                <time>
                                    @if(strlen($last->created) < 6) <i class="icons icon-clock"></i>@endif
                                    {{ $last->created }}
                                </time>
                            </div>
                            <a class="link-title" href="
                                @if(session()->has('doc'))
                            {{ route('events', $last->alias) }}">
                                @else
                                    {{ route('articles', $last->alias) }}">
                                @endif
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
    <div class="aside-block aside-articles">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line @if(session()->has('doc')) line-purple @endif"></div>
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
                            @if($status)
                                <p>
                                    <a class="link-title" href="{{ route('doctors_art', $article->alias) }}">
                                        <h3>{{ str_limit($article->title, 64) }}</h3>
                                    </a>
                                </p>
                            @else
                                <p>
                                    <a class="link-title" href="{{ route('articles', $article->alias) }}">
                                        <h3>{{ str_limit($article->title, 64) }}</h3>
                                    </a>
                                </p>
                            @endif
                        </article>
                        @if(0 == $loop->index)
                            <hr> @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @if(session()->has('doc'))
        <div class="aside-block">
            <div class="advertising">
                {!! $advertising['sidebar'] ?? '<img src="'. asset('estet') .'/bannera/200x325.png" >' !!}
            </div>
        </div>
    @endif
    @include('layouts.horoscope.sidebar')
    <div class="aside-block to-hide">
        <div class="advertising">
            {!! $advertising['sidebar_2'] ?? '<img src="'. asset('estet') .'/bannera/200x325.png" >' !!}
        </div>
    </div>
    <div class="aside-block to-hide">
        @include('layouts.subscribe')
    </div>
</aside>