@if(is_object($articles) && $articles->isNotEmpty())
    @if($articles)
        @foreach($articles as $article)
            @if($loop->iteration%2 !== 0)
                <div class="statyi-content">
                    <div class="statyi-block">
                        <div class="img-statyi">
                            <a href="{{ route($own, $article->alias) }}">
                                <img src="{{ asset('/images/article/small').'/'.$article->image->path }}"
                                     alt="{{$article->image->alt}}" title="{{ $article->image->title }}">
                            </a>
                        </div>
                        <div class="block-text">
                            <time>
                                @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                                {{ $article->created }}
                            </time>
                            <a href="{{ route($own, $article->alias) }}">
                                <h3>{{ str_limit($article->title, 72) }}</h3>
                            </a>
                        </div>
                    </div>
                    @if($loop->last)
                </div>
            @endif
            @else
                <div class="statyi-block">
                    <div class="img-statyi">
                        <a href="{{ route($own, $article->alias) }}">
                            <img src="{{ asset('/images/article/small').'/'.$article->image->path }}"
                                 alt="{{$article->image->alt}}" title="{{ $article->image->title }}">
                        </a>
                    </div>
                    <div class="block-text">
                        <time>
                            @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                            {{ $article->created }}
                        </time>
                        <a href="{{ route($own, $article->alias) }}">
                            <h3>{{ str_limit($article->title, 72) }}</h3>
                        </a>
                    </div>
                </div>
                </div>
            @endif
        @endforeach
    @endif
@endif