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
                    <span itemprop="title">Врачи</span>
                </a>
            </div>
            /
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
                                    <img src="{{ asset(config('settings.theme'))  . '/img/profile/main/' . ($profile->photo ?? '../no_photo.jpg') }}"
                                         alt="{{ $profile->lastname }}" title="{{ $profile->lastname }}">
                                    <div class="details-page-info">
                                        <div class="rating">
                                            <div class="top-rating" data-id="{{ $profile->id }}" data-source="2">
                                                <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                            </div>
                                            <p>{!! '<span class="avg">'.($ratio->avg ?? 0).'</span>' .' / 5 - (голосов - ' . ($ratio->count ?? 0) . ')' !!}</p>
                                        </div>
                                        <div class="info-kompani">
                                            <div class="kompani-contacts">
                                                <p>Специализация:</p>
                                                <span>{{ $profile->specialties->implode('name', ', ') ?? ''}}</span>
                                            </div>
                                            <div class="kompani-contacts">
                                                <p>Регалии:</p>
                                                <span>{{ $profile->category ?? ''}}</span>
                                            </div>
                                            <div class="kompani-contacts">
                                                <div class="contacts-tel">
                                                    <p>Телефон:</p>
                                                </div>
                                                <div class="contacts-tel">
                                                    <a href="tel: +3800443312425">{{ $profile->phone ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="kompani-contacts">
                                                <p>Web-сайт:</p>
                                                <a href="{{ $profile->site ?? ''}}">{{ str_limit($profile->site, 32) ?? ''}}</a>
                                            </div>
                                            <div class="kompani-contacts">
                                                <p>Опыт работы(полных лет):</p>
                                                {{ $profile->expirience ?? ''}}
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
                                            @if(!empty($profile->services) && is_array($profile->services))
                                                <p>Услуги:</p>
                                                <ul class="hide-ul" data-init-h="83">
                                                    @foreach($profile->services as $service)
                                                        <li>{{ $service }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="details-page">
                                    <h3>{{ $profile->name .' '. $profile->lastname}}</h3>
                                    <p>
                                        {{ $profile->job ?? ''}}
                                    </p>
                                    <hr>
                                    <span>{{ $profile->address ?? ''}}</span>
                                    <div class="kompani-info">
                                        <div class="brand-head">
                                            <div class="katalog-line"></div>
                                            <span>О докторе</span>
                                        </div>
                                        {!! $profile->content ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- section-5 -->
                        <div class="brand-publications">
                            <div class="brand-head">
                                <div class="katalog-line"></div>
                                <span>Публикации доктора</span>
                            </div>
                            @if(!empty($blogs))
                                <div class="publications">
                                    @foreach($blogs as $blog)
                                        <article>
                                            <a href="{{ route('blogs', $blog->alias) }}"><p>{{ $blog->title }}</p></a>
                                        </article>
                                        @if(!$loop->last)
                                            <hr> @endif
                                    @endforeach

                                </div>
                            @endif
                        </div>
                        <div class="comment-post">
                            @include('layouts.comments_form', ['id' => $profile->id, 'source' => 6, 'comments' => $comments])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! $sidebar !!}
    </div>
</section>