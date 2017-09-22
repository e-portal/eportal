<section id="section-1" class="blog-page">
    <div class="left-title">
        <div class="line-container text-vertical">
            <div class="vertical-line
             @if(session()->has('doc')) line-purple @endif
             "></div>
            <h2>Каталог</h2>
        </div>
    </div>
    <div class="content">
        <!-- section 2 -->
        <div class="bread-crumbs">
            <div itemscope itemtype="#">
                <a href="#" itemprop="url">
                    <span itemprop="title">Бренды и их представители</span>
                </a>
            </div>/
            <div itemscope itemtype="#">
                <span itemprop="title">Alfa Spa Development</span>
            </div>
        </div>
        <div class="katalog-page">

            <div class="main-content page-content">
                <!-- section-3 -->
            @include('catalog.nav')
                <!-- section-4 -->
                <div class="blog-section-post">
                    <div class="content content-blog">
                        <div class="catalog-internal">
                            <div class="block-info">
                                <div class="details-page">
                                    <img src="{{ asset('/images/establishment/main') . '/' . $brand->logo }}" alt="{{ $brand->alt }}" title="{{ $brand->title }}">
                                    <div class="details-page-info">
                                        <div class="rating">
                                            <div class="top-rating" data-id="{{ $brand->id }}" data-source="1">
                                                <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                            </div>
                                            <p>{{ ($ratio->avg ?? 0) .' / 5 - (голосов - ' . ($ratio->count ?? 0) . ')'}}</p>
                                        </div>
                                        <div class="info-kompani">
                                            <div class="kompani-contacts">
                                                <p>Категория:</p>
                                                <span>{{ trans('ru.' . $brand->category) }}</span>
                                            </div>
                                            <div class="kompani-contacts">
                                                <p>Головная компания:</p>
                                                <span>{{ $parent->title }}</span>
                                            </div>
                                            <div class="kompani-contacts">
                                                <div class="contacts-tel">
                                                    <p>Телефон:</p>
                                                </div>
                                                <div class="contacts-tel">
                                                    <a href="tel: +3800443312425">{{ $brand->phones }}</a>
                                                </div>
                                            </div>
                                            <div class="kompani-contacts">
                                                <p>Web-сайт:</p>
                                                <a href="{{ $brand->site }}">{{ str_limit($brand->site, 32) }}</a>

                                            </div>
                                            @isset($brand->extra[0])
                                                <div class="kompani-contacts">
                                                    <p>{{ $brand->extra[0][0] }}</p>
                                                    {{ $brand->extra[0][1] }}
                                                </div>
                                            @endisset
                                            @isset($brand->extra[1])
                                                <div class="kompani-contacts">
                                                    <p>{{ $brand->extra[1][0] }}</p>
                                                    {{ $brand->extra[1][1] }}
                                                </div>
                                            @endisset
                                        </div>
                                        <div class="kervices-kompani">
                                            @if(!empty($brand->spec))
                                                <p>Описание продкта:</p>
                                                {{ $brand->spec }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="details-page">
                                    <h3>{{ $brand->title }}</h3>
                                    @if(!empty($brand->description))
                                        <p>
                                            {{ $brand->description }}
                                        </p>
                                    @endif
                                    <hr>
                                    <span>{{ $brand->address }}</span>
                                    <div class="kompani-info">
                                        <div class="brand-head">
                                            <div class="katalog-line"></div>
                                            <span>О нас</span>
                                        </div>
                                        {!! $brand->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- section-5 -->
                        <div class="brand-publications">
                            <div class="brand-head">
                                <div class="katalog-line"></div>
                                <span>Публикации бренда</span>
                            </div>
                            @if(!empty($brand->articles))
                            <div class="publications">
                                @foreach($brand->articles as $article)
                                    <article>
                                        <a href="{{ route('articles', $article->alias) }}"><p>{{ $article->title }}</p></a>
                                    </article>
                                    @if(!$loop->last) <hr> @endif
                                @endforeach

                            </div>
                            @endif
                        </div>
                        @include('layouts.comments_form', ['id' => $brand->id, 'source' => 3])
                    </div>
                </div>
            </div>
        </div>
        {!! $sidebar !!}

    </div>
</section>
{{--@if(count($brand->comments) > 0)
    <hr>
    @foreach($brand->comments as $comment)
        @if(0 !== $comment->parent_id)
            @continue
        @endif
        <div class="row">
            <table class="table">
                <tr><th>#</th><th>{{ $comment->id }}</th></tr>
                <tr><td>E-mail</td><td>{{ $comment->email }}</td></tr>
                <tr><td>Имя</td><td>{{ $comment->name }}</td></tr>
                <tr><td>Коментарий</td><td>{{ $comment->text }}</td></tr>
            </table>
        </div>
        @include('comment', ['children' => $brand->comments, 'id' => $comment->id])
    @endforeach
@endif--}}
