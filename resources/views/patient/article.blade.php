
<!--section 1-->
<section id="section-1" class="blog-page">
    <div class="left-title left-title-planshet">
        <div class="line-container text-vertical">
            <div class="vertical-line"></div>
            <h2>{{ $article->category->name }}</h2>
        </div>
    </div>

    <div class="content content-vnutrennaya">
        <div class="title-main ">
            <h3 class="heading-title">
                {{ $article->title }}
            </h3>
        </div>
        <div class="main-content">
            <div class="content-centr">

                <div class="main-img">
                    @if(!empty($article->image->path))
                        <img src="{{ asset('/images/article/main') . '/' . $article->image->path }}"
                             alt="{{ $article->image->alt }}" title="{{ $article->image->title }}">
                    @else
                        <img src="{{ asset('/estet/img/estet.png') }}"
                             alt="Estet-portal" title="Estet-portal">
                    @endif
                </div>
                <div class="main-img-info">
                    <div class="images">
                        {!! $article->content !!}
                    </div>
                </div>
                <!----------------------------------blog-categories---------------------------------->
                <div class="blog-categories">
                    <div class="select select-blue">
                        @foreach($article->tags as $tag)
                            <a href="{{ route('articles_tag',['tag_alias'=> $tag->alias]) }}">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
                <!----------------------------------blog-categories---------------------------------->
            </div>
            @include('layouts.comments.comments_form', ['id' => $article->id, 'source' => 1, 'comments' => $article->comments])
        </div>
        {!! $sidebar !!}
    </div>
</section>
<!--  section 2-->
@if(!empty($same))
<section id="section-2" class="articles">
    <div class="left-title">
        <div class="line-container">
            <div class="vertical-line"></div>
            <h2>Похожие статьи</h2>
        </div>
    </div>
    <div class="content">
        <!--articles-gray-->
        <div class="articles-horizontal">
            @foreach($same as $preview)
                <article>
                    <a class="link-img" href="{{ route('articles', $preview->alias) }}" rel="nofollow">
                        <img src="{{ asset('/images/article/small') . '/' . $preview->image->path }}"
                             alt="{{ $preview->image->alt }}" title="{{ $preview->image->title }}">
                    </a>
                    <div class="title-time">
                        <time>
                            @if(strlen($preview->created) < 6) <i class="icons icon-clock"></i> @endif
                            {{ $preview->created }}
                        </time>
                    </div>
                    <a class="link-title" href="{{ route('articles', $preview->alias) }}">
                        <h3>{{ str_limit($preview->title, 64) }}</h3>
                    </a>
                </article>
                @if(!$loop->last)
                    <div class="line-vertical"></div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif
{{--BreadCrumbs--}}
<div class="bread-crumbs" id="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <a href="{{ route('main') }}" itemprop="item">
            <span itemprop="name" class="label1">Главная</span>
            <meta itemprop="position" content="1"/>
        </a>
    </div>
    /
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <a href="{{ route('article_cat', $article->category->alias) }}" itemprop="item">
            <span itemprop="name" class="label1">{{ $article->category->name }}</span>
            <meta itemprop="position" content="2"/>
        </a>
    </div>
    /
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <span itemprop="name" class="label1">{{ str_limit($article->title, 72) }}</span>
        <meta itemprop="position" content="3"/>
    </div>
</div>
{{--BreadCrumbs--}}