<section id="section-1" class="blog-page">
    <div class="left-title left-title-planshet ">
        <div class="line-container text-vertical">
            <div class="vertical-line"></div>
            <h2>{{ $tag->name }}</h2>
        </div>
    </div>
    <div class="content">
        <div class="blog-categories">
            <div class="select select-blue">
                <a href="#">{{ $tag->name }}</a>
            </div>
        </div>
        <div class="main-content">
            @if($blogs)
                @foreach($blogs as $blog)
                    @if($loop->iteration%2 !== 0)
                        <div class="statyi-content">
                            <div class="statyi-block">
                                <div class="img-statyi">
                                    <img src="{{ asset('/images/blog/small').'/'.$blog->blog_img->path }}"
                                         alt="{{$blog->blog_img->alt}}" title="{{ $blog->blog_img->title }}">
                                </div>
                                <div class="block-text">
                                <span>
                                    @if(strlen($blog->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $blog->created }}
                                </span>
                                    <a href="{{ route('blogs', $blog->alias) }}">
                                        <h3>{{ str_limit($blog->title, 72) }}</h3>
                                    </a>
                                </div>
                            </div>
                            @if($loop->last)
                        </div>
                    @endif
                    @else
                        <div class="statyi-block">
                            <div class="img-statyi">
                                <img src="{{ asset('/images/blog/small').'/'.$blog->blog_img->path }}"
                                     alt="{{$blog->blog_img->alt}}" title="{{ $blog->blog_img->title }}">
                            </div>
                            <div class="block-text">
                                <span>
                                    @if(strlen($blog->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $blog->created }}
                                </span>
                                <a href="{{ route('blogs', $blog->alias) }}">
                                    <h3>{{ str_limit($blog->title, 72) }}</h3>
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
            @if(is_object($blogs) && !empty($blogs->lastPage()) && $blogs->lastPage() > 1)
                <ul>
                    @if($blogs->currentPage() !== 1)
                        <li>
                            <a rel="prev" href="{{ $blogs->url(($blogs->currentPage() - 1)) }}" class="prev">
                                <
                            </a>
                        </li>
                    @endif
                    @if($blogs->currentPage() >= 3)
                        <li><a href="{{ $blogs->url($blogs->lastPage()) }}">1</a></li>
                    @endif
                    @if($blogs->currentPage() >= 4)
                        <li><a href="#">...</a></li>
                    @endif
                    @if($blogs->currentPage() !== 1)
                        <li>
                            <a href="{{ $blogs->url($blogs->currentPage()-1) }}">{{ $blogs->currentPage()-1 }}</a>
                        </li>
                    @endif
                    <li><a class="active disabled">{{ $blogs->currentPage() }}</a></li>
                    @if($blogs->currentPage() !== $blogs->lastPage())
                        <li>
                            <a href="{{ $blogs->url($blogs->currentPage()+1) }}">{{ $blogs->currentPage()+1 }}</a>
                        </li>
                    @endif
                    @if($blogs->currentPage() <= ($blogs->lastPage()-3))
                        <li><a href="#">...</a></li>
                    @endif
                    @if($blogs->currentPage() <= ($blogs->lastPage()-2))
                        <li><a href="{{ $blogs->url($blogs->lastPage()) }}">{{ $blogs->lastPage() }}</a></li>
                    @endif
                    @if($blogs->currentPage() !== $blogs->lastPage())
                        <li>
                            <a rel="next" href="{{ $blogs->url(($blogs->currentPage() + 1)) }}" class="next">
                                >
                            </a>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
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
        <a href="{{ route('blogs') }}" itemprop="item">
            <span itemprop="name" class="label1">Блог</span>
            <meta itemprop="position" content="2"/>
        </a>
    </div>
    /
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <span itemprop="name" class="label1">Тэг - {{ $tag->name }}</span>
        <meta itemprop="position" content="3"/>
    </div>
</div>
{{--BreadCrumbs--}}