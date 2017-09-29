<section id="section-1" class="meropryyatyya blog-page">
    <div class="left-title">
        <div class="line-container text-vertical">
            <div class="vertical-line line-purple"></div>
            <h2>Мероприятия</h2>
        </div>
    </div>
    <div class="content">
        <div class="main-content">
            <!--section 2-->
            <h3>{{ $event->title }}</h3>
            <!--section 3-->
            <div class="img-meropryyatyya">
                <img src="{{ asset('/images/event/main') . '/' . $event->logo->path }}"
                     alt="{{ $event->logo->alt }}" title="$event->logo->title">
            </div>
            <!--section 4-->
            <div class="button-subscribe" data-id="{{ $event->id }}">
                @if(!empty($event->extlink))
                    <a href="{{ $event->extlink }}">
                        <i class="icon-subscribe"></i> Записаться на мероприятие
                    </a>
                @elseif(!empty($event->extmail))
                    <a class="js-pop"><i class="icon-subscribe"></i> Записаться на мероприятие</a>
                @endif
            </div>
            <!--section 5-->
            <div class="text-meropryyatyya">
                {{ $event->description }}
            </div>
            <!--section 6-->
            @if(is_object($event->slider) && $event->slider->isNotEmpty())
            <div class="slide-meropryyatyya">
                @foreach($event->slider as $slider)
                    <img src="{{ asset('/images/event/slider/main') . '/' . $slider->path }}"
                         alt="{{ $slider->alt }}" title="{{ $slider->title }}">
                @endforeach
            </div>
            @endif
            <div class="meropryyatyya-data">
                {!! $event->content !!}
            </div>


            <div class="button-subscribe" data-id="{{ $event->id }}">
                @if(!empty($event->extlink))
                    <a href="{{ $event->extlink }}">
                        <i class="icon-subscribe"></i> Записаться на мероприятие
                    </a>
                @elseif(!empty($event->extmail))
                    <a class="js-pop"><i class="icon-subscribe"></i> Записаться на мероприятие</a>
                @endif
            </div>
            <!--section 7-3-->
            @include('layouts.comments.comments_form', ['id' => $event->id, 'source' => 4, 'comments' => $event->comments])
        </div>
        <!--section 8-->
        {!! $sidebar !!}
    </div>
</section>



<!--section 9-->
    <section id="section-2" class="meropryyatyya-health">
        <div class="left-title">
            <div class="line-container">
                <div class="vertical-line line-purple"></div>
                <h2>Похожие</h2>
            </div>
        </div>
        <div class="content">
            <div class="articles-horizontal">
                @if(!empty($similars))
                    @foreach($similars as $sevent)
                        <article>
                            <a class="link-img" href="{{ route('events', $sevent->alias) }}" rel="nofollow">
                                <img src="{{ asset('images\event\small').'/'. $sevent->logo->path}}"
                                     alt="{{ $sevent->logo->alt }}"
                                     title="{{ $sevent->logo->title }}"
                                >
                            </a>
                            <div>
                                <div class="title-time">
                                    <time>
                                        @if(strlen($sevent->created) < 6) <i class="icons icon-clock"></i> @endif
                                        {{ $sevent->created }}
                                    </time>
                                </div>
                                <a class="link-title" href="{{ route('events', $sevent->alias) }}">
                                    <h3>{{ $sevent->title }}</h3>
                                </a>
                            </div>
                        </article>
                        @if(!$loop->last)
                            <div class="line-vertical"></div>
                        @endif
                    @endforeach
                @endif
            </div>

        </div>
    </section>
<!--section 10-->
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
        <a href="{{ route('events') }}" itemprop="item">
            <span itemprop="name" class="label1">Мероприятия</span>
            <meta itemprop="position" content="2"/>
        </a>
    </div>
    /
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <span itemprop="name" class="label1">{{ str_limit($event->title, 72) }}</span>
        <meta itemprop="position" content="3"/>
    </div>
</div>
{{--BreadCrumbs--}}