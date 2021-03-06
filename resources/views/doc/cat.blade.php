<section id="section-1" class="blog-page statyi-cat">
    <div class="left-title left-title-planshet ">
        <div class="line-container text-vertical">
            <div class="vertical-line"></div>
            <h2>{{ $cat->name }}</h2>
        </div>
    </div>
    <div class="content">
        <div class="main-content">
            @if($articles)
                @foreach($articles as $article)
                    @if($loop->iteration%2 !== 0)
                        <div class="statyi-content">
                            <div class="statyi-block">
                                <div class="img-statyi">
                                    <a href="{{ route('doctors_art', $article->alias) }}">
                                        <img src="{{ asset('/images/article/small').'/'.$article->image->path }}"
                                             alt="{{$article->image->alt}}" title="{{ $article->image->title }}">
                                    </a>
                                </div>
                                <div class="block-text">
                                    <time>
                            @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                            {{ $article->created }}
                                    </time>
                                    <a href="{{ route('doctors_art', $article->alias) }}">
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
                                <a href="{{ route('doctors_art', $article->alias) }}">
                                    <img src="{{ asset('/images/article/small').'/'.$article->image->path }}"
                                         alt="{{$article->image->alt}}" title="{{ $article->image->title }}">
                                </a>
                            </div>
                            <div class="block-text">
                                <time>
                        @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                        {{ $article->created }}
                                </time>
                                <a href="{{ route('doctors_art', $article->alias) }}">
                                    <h3>{{ str_limit($article->title, 72) }}</h3>
                                </a>
                            </div>
                        </div>
        </div>
        @endif
        @endforeach
        @endif
    </div>
    {!! $sidebar !!}
    <div class="pagination content-blog">
        <!--PAGINATION-->
        <div class="pagination-blog">
            @if(is_object($articles) && !empty($articles->lastPage()) && $articles->lastPage() > 1)
                <ul>
                    @if($articles->currentPage() !== 1)
                        <li>
                            <a rel="prev" href="{{ $articles->url(($articles->currentPage() - 1)) }}" class="prev">
                                <
                            </a>
                        </li>
                    @endif
                    @if($articles->currentPage() >= 3)
                        <li><a href="{{ $articles->url($articles->lastPage()) }}">1</a></li>
                    @endif
                    @if($articles->currentPage() >= 4)
                        <li><a href="#">...</a></li>
                    @endif
                    @if($articles->currentPage() !== 1)
                        <li>
                            <a href="{{ $articles->url($articles->currentPage()-1) }}">{{ $articles->currentPage()-1 }}</a>
                        </li>
                    @endif
                    <li><a class="active disabled">{{ $articles->currentPage() }}</a></li>
                    @if($articles->currentPage() !== $articles->lastPage())
                        <li>
                            <a href="{{ $articles->url($articles->currentPage()+1) }}">{{ $articles->currentPage()+1 }}</a>
                        </li>
                    @endif
                    @if($articles->currentPage() <= ($articles->lastPage()-3))
                        <li><a href="#">...</a></li>
                    @endif
                    @if($articles->currentPage() <= ($articles->lastPage()-2))
                        <li><a href="{{ $articles->url($articles->lastPage()) }}">{{ $articles->lastPage() }}</a></li>
                    @endif
                    @if($articles->currentPage() !== $articles->lastPage())
                        <li>
                            <a rel="next" href="{{ $articles->url(($articles->currentPage() + 1)) }}" class="next">
                                >
                            </a>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    </div>
    <div class="more-articles">
        <button type="submit">Больше статей</button>
    </div>
    </div>
</section>
{{--BreadCrumbs--}}
<div class="bread-crumbs" id="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <a href="{{ route('doctors') }}" itemprop="item">
            <span itemprop="name" class="label1">Главная</span>
            <meta itemprop="position" content="1"/>
        </a>
    </div>
    /
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <span itemprop="name" class="label1">{{ $cat->name }}</span>
        <meta itemprop="position" content="2"/>
    </div>
</div>
{{--BreadCrumbs--}}