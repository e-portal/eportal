<!--section 1-->
<section id="section-1" class="blog-page blog-vnutrenyyaya">
    <div class="left-title">
        <div class="line-container text-vertical">
            <div class="vertical-line line-purple"></div>
            <h2>Блог</h2>
        </div>
    </div>
    <div class="content">
        <div class="main-content">
            <!-- section-2 -->
            <section id="section-2" class="profile-blog">

                <div class="blog-profile">
                    <img src="{{asset('/estet/img/profile/small') . '/' . $blog->person->person->photo }}"
                         alt="{{ $blog->person->person->photo_alt ?? $blog->person->person->lastname . ' ' . $blog->person->person->name }} "
                         title="{{ $blog->person->person->photo_title ?? $blog->person->person->lastname . ' ' . $blog->person->person->name}} "
                    >

                    <div>

                        <div class="title-time">
                            <time>
                                @if(strlen($blog->created) < 6) <i class="icons icon-clock"></i> @endif
                                {{ $blog->created }}
                            </time>
                        </div>
                        <div class="name">
                            <p>
                                {{ $blog->person->person->lastname }}
                                <br>
                                {{ $blog->person->person->name }}
                            </p>
                        </div>
                        <div class="specialty">
                            <p>{{ $blog->person->person->specialties->implode('name', ', ') ?? '' }}</p>
                        </div>
                        <div class="achievements">
                            <p>{{ $blog->person->person->category }}</p>
                        </div>

                    </div>
                </div>
                <div class="blog-image">
                    <img src="{{asset('/images/blog/main') . '/' . $blog->blog_img->path}}"
                         alt="{{ $blog->blog_img->alt }}" title="{{ $blog->blog_img->title }}">
                </div>

            </section>
            <!-- section-3 -->
            <div class="blog-text">
                <h3>{{ $blog->title }}</h3>
                <div class="blog-post">
                    {!! $blog->content !!}
                </div>

            </div>
            <!-- section-4 -->
            <div class="blog-categories">

                <div class="select">

                    @foreach($blog->tags as $tag)
                        <a href="{{ route('blog_tag',['tag_alias'=> $tag->alias]) }}">{{ $tag->name }}</a>
                    @endforeach

                </div>

            </div>
            <!-- section-5 -->
            @include('layouts.comments.comments_form', ['id' => $blog->id, 'source' => 2, 'comments' => $blog->comments])
        </div>
        {!! $sidebar !!}
    </div>
</section>
<!--section 4-->
<section id="section-4" class="blog-similar-articles">
    <div class="left-title">
        <div class="line-container">
            <div class="vertical-line line-purple"></div>
            <h2>Похожие статьи</h2>
        </div>
    </div>
    <div class="content content-blog">
        <div class="articles-horizontal">
            @foreach($blogs as $blog)
                <article>
                    <a class="link-img" href="{{ route('blogs',['blog'=> $blog->alias]) }}" rel="nofollow">
                        <img src="{{ asset('/images/blog/small') . '/' . $blog->blog_img->path }}"
                             alt="{{ $blog->blog_img->alt }}" title="{{ $blog->blog_img->title }}">
                    </a>
                    <div class="title-time">
                        <time>
                            @if(strlen($blog->created) < 6) <i class="icons icon-clock"></i> @endif
                            {{ $blog->created }}
                        </time>
                        <p>{{ $blog->category->name }}</p>
                    </div>
                    <a class="link-title" href="{{ route('blogs',['blog'=> $blog->alias]) }}">
                        <h3>{{ str_limit($blog->title, 72) }}</h3>
                    </a>
                    <div class="blog-read-more">
                        <div class="author">
                            <i class="icon-men"></i>
                            <p>{{ $blog->person->person->name . ' ' . $blog->person->person->lastname }}</p>
                        </div>
                        <div class="button-read-more">
                            <a href="{{ route('blogs',['blog'=> $blog->alias]) }}">Подробнее</a>
                    </div>
                </div>
                </article>
            @endforeach
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
        <a href="{{ route('blogs_cat', $blog->category->alias) }}" itemprop="item">
            <span itemprop="name" class="label1">{{ $blog->category->name }}</span>
            <meta itemprop="position" content="3"/>
        </a>
    </div>
    /
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <span itemprop="name" class="label1">{{ $blog->title }}</span>
        <meta itemprop="position" content="4"/>
    </div>
</div>
{{--BreadCrumbs--}}