<section id="section-1" class="blog-page">
    <div class="left-title">
        <div class="line-container text-vertical">
            <div class="vertical-line
            @if(session()->has('doc')) line-purple @endif
            ">
            </div>
            <h2>Каталог</h2>
        </div>
    </div>
    <div class="content">
        <!-- section 2 -->

        <div class="katalog-page katalog-internal">

            <div class="main-content page-content">
                <!-- section-3 -->
            @include('catalog.nav')

            <!-- section-4 -->
                <div class="blog-section-post">
                    <div class="content content-blog">
                        <div class="catalog-internal">
                            <div class="block-info">
                                <div class="details-page">
                                    <img src="{{ asset('/images/establishment/main') . '/' . $distributor->logo }}"
                                         alt="{{ $distributor->alt }}" title="{{ $distributor->title }}">
                                    <div class="details-page-info">
                                        <div class="rating">
                                            <div class="top-rating" data-id="{{ $distributor->id }}" data-source="1">
                                                <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                            </div>
                                            <p>{!! '<span class="avg">'.($ratio->avg ?? 0).'</span>' .' / 5 - (голосов - ' . ($ratio->count ?? 0) . ')'!!}</p>
                                        </div>
                                        <div class="info-kompani">
                                            <div class="kompani-contacts">
                                                <p>Категория:</p>
                                                <span>{{ trans('ru.' . $distributor->category) }}</span>
                                            </div>
                                            <div class="kompani-contacts">
                                                <div class="contacts-tel">
                                                    <p>Телефон:</p>
                                                </div>
                                                <div class="contacts-tel">
                                                    <a href="tel: +3800443312425">{{ $distributor->phones }}</a>
                                                </div>
                                            </div>
                                            <div class="kompani-contacts">
                                                <p>Web-сайт:</p>
                                                <a href="{{ $distributor->site }}">{{ str_limit($distributor->site, 32) }}</a>
                                            </div>
                                            <div class="kompani-contacts">
                                                <p>Дочерние бренды:</p>
                                                @if(!empty($children))
                                                    <div id="children" class="panel-collapse collapse">
                                                        @foreach($children as $child)
                                                            <a href="{{ route('brands', $child->alias) }}"><span>{{ $child->title }}</span></a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            @isset($distributor->extra[0])
                                                <div class="kompani-contacts">
                                                    <p>{{ $distributor->extra[0][0] }}</p>
                                                    <span>{{ $distributor->extra[0][1] }}</span>
                                                </div>
                                            @endisset
                                            @isset($distributor->extra[1])
                                                <div class="kompani-contacts">
                                                    <p>{{ $distributor->extra[1][0] }}</p>
                                                    <span>{{ $distributor->extra[1][1] }}</span>
                                                </div>
                                            @endisset
                                        </div>
                                        <div class="kervices-kompani">
                                            @if(!empty($distributor->services))
                                                <p>Категории товаров:</p>
                                                <lu>
                                                    @foreach($distributor->services as $service)
                                                        <li>{{ $service }}</li>
                                                    @endforeach
                                                </lu>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="details-page">
                                    <h3>{{ $distributor->title }}</h3>
                                    @if(!empty($distributor->description))
                                        <p>
                                            {{ $distributor->description }}
                                        </p>
                                    @endif
                                    <hr>
                                    <span>{{ $distributor->address }}</span>
                                    <div class="kompani-info">
                                        <div class="brand-head">
                                            <div class="katalog-line"></div>
                                            <span>О нас</span>
                                        </div>
                                        {!! $distributor->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- section-5 -->
                        <div class="brand-publications">
                            <div class="brand-head">
                                <div class="katalog-line"></div>
                                <span>Публикации дистрибутора</span>
                            </div>
                            @if(!empty($distributor->articles))
                                <div class="publications">
                                    @foreach($distributor->articles as $article)
                                        <article>
                                            <a href="{{ route('articles', $article->alias) }}"><p>{{ $article->title }}</p></a>
                                        </article>
                                        @if(!$loop->last) <hr> @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @include('layouts.comments.comments_form', ['id' => $distributor->id, 'source' => 3, 'comments' => $distributor->comments])
                    </div>
                </div>

            </div>
        </div>
        {!! $sidebar !!}

    </div>
</section>
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
        <a href="{{ route('distributors')}}" itemprop="item">
            <span itemprop="name" class="label1">Дистрибуторы</span>
            <meta itemprop="position" content="2"/>
        </a>
    </div>
    /
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <span itemprop="name" class="label1">{{ $distributor->title }}</span>
        <meta itemprop="position" content="3"/>
    </div>
</div>
{{--BreadCrumbs--}}