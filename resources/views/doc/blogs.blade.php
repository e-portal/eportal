<!--section 1-->
<section id="section-1" class="blog-page">
    <div class="left-title">
        <div class="line-container text-vertical">
            <div class="vertical-line line-purple"></div>
            <h2>Блог</h2>
        </div>
    </div>


    <div class="content">
        <div class="main-content page-content">
            <!-- section-2 -->
            <div class="blog-section hidden-blog">
                @foreach($cats as $cat)
                    <div class="categories-section ">
                        <a href="{{ route('blogs_cat', $cat->alias) }}">
                            <img src="{{ asset('estet') }}/img/blog/7.png" alt="">
                            <span>{{ $cat->name }}</span>
                        </a>
                    </div>
                @endforeach

                <button class="will-open" type="submit">Больше</button>
            </div>

            <!-- section-3 -->
            <div class="blog-categories">
                <div class="content">
                    <div class="categories">
                        <p>Категории</p>
                    </div>
                    <div class="select hidden-blog">
                        @foreach($tags as $tag)
                            <a href="{{ route('blog_tag', $tag->alias) }}">{{ $tag->name }}</a>
                        @endforeach
                        <button class="will-open" type="submit">Больше</button>
                    </div>
                </div>
            </div>
            <!-- section-4 -->
            <div class="blog-section-post">
                <div class="content content-blog">
                    <div class="articles-horizontal">
                        @if(!empty($blogs))
                            @foreach($blogs as $blog)
                                <article>
                                    <a class="link-img" href="{{ route('blogs', $blog->alias) }}" rel="nofollow">
                                        <img title="{{ $blog->blog_img->title }}" alt="{{ $blog->blog_img->alt }}"
                                             src="{{ asset('/images/blog/middle') . '/' . $blog->blog_img->path }}">
                                    </a>
                                    <div class="title-time">
                                        <time>
                                            @if(strlen($blog->created) < 6) <i class="icons icon-clock"></i> @endif
                                            {{ $blog->created }}
                                        </time>
                                        <p>{{ $blog->category->name }}</p>
                                    </div>
                                    <a class="link-title" href="{{ route('blogs', $blog->alias) }}">
                                        <h3>{{ str_limit($blog->title, 72) }}</h3></a>
                                    <div class="blog-read-more">
                                        <div class="author">
                                            <i class="icon-men"></i>
                                            <p>{{ str_limit(($blog->person->person->lastname . ' ' . $blog->person->person->name), 16) }}</p>
                                        </div>
                                        <div class="button-read-more">
                                            <a href="{{ route('blogs', $blog->alias) }}">Подробнее</a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="pagination content-blog">
                <!--PAGINATION-->
                <div class="pagination-blog">
                    @if($blogs->lastPage() > 1)
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

                @include('layouts.social-networks')

            </div>
        </div>

        {!! $sidebar !!}

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
        <span itemprop="name" class="label1">Блог</span>
        <meta itemprop="position" content="2"/>
    </div>
</div>
{{--BreadCrumbs--}}