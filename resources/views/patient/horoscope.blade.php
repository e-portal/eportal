<div class="title">
    <!---------------------------Logo end--------------------------->
    <h3 class="heading-title">
        Ежемесячный гороскоп здоровья и красоты<br> на {{ trans('ru.' . date('m')) }} 2017 по знакам зодиака
    </h3>

</div>
<!--section 1-->
<section id="section-1" class="horoscope">
    <div class="left-title left-title-planshet">
        <div class="line-container heading-title-main">
            <div class="vertical-line"></div>
            <h2>Гороскоп красоты</h2>
        </div>
    </div>
    <div class="content">
        <div class="hrp-main hrp-main-media">
            <div class="hrp">
                <a href="#aries" class="icons-img z-index-item-up Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-oven-active"></i>
                            <i class="horoscope-icons horoscope-icons-oven"></i>
                        </div>
                        <span>ОВЕН</span>
                    </div>
                </a>
                <a href="#taurus" class="icons-img z-index-item-up Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-telets-active"></i>
                            <i class="horoscope-icons horoscope-icons-telets"></i>
                        </div>
                        <span>ТЕЛЕЦ</span>
                    </div>
                </a>
                <a href="#gemini" class="icons-img z-index-item-up Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-bliznetsy-active"></i>
                            <i class="horoscope-icons horoscope-icons-bliznetsy"></i>
                        </div>
                        <span>БЛИЗНЕЦЫ</span>
                    </div>
                </a>
                <a href="#cancer" class="icons-img z-index-item-up Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-rak-active"></i>
                            <i class="horoscope-icons horoscope-icons-rak"></i>
                        </div>
                        <span>РАК</span>
                    </div>
                </a>
                <a href="#leo" class="icons-img z-index-item-up Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-lev-active"></i>
                            <i class="horoscope-icons horoscope-icons-lev"></i>
                        </div>
                        <span>ЛЕВ</span>
                    </div>
                </a>

                <a href="#virgo" class="icons-img z-index-item-up Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-deva-active"></i>
                            <i class="horoscope-icons horoscope-icons-deva"></i>
                        </div>
                        <span>ДЕВА</span>
                    </div>
                </a>
                <a href="#libra" class="icons-img z-index-item-down Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-vesy-active"></i>
                            <i class="horoscope-icons horoscope-icons-vesy"></i>
                        </div>
                        <span>ВЕСЫ</span>
                    </div>
                </a>
                <a href="#scorpio" class="icons-img z-index-item-down Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-skorpion-active"></i>
                            <i class="horoscope-icons horoscope-icons-skorpion"></i>
                        </div>
                        <span>СКОРПИОН</span>
                    </div>
                </a>
                <a href="#sagittarius" class="icons-img z-index-item-down Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-strelets-active"></i>
                            <i class="horoscope-icons horoscope-icons-strelets"></i>
                        </div>
                        <span>СТРЕЛЕЦ</span>
                    </div>
                </a>

                <a href="#capricorn" class="icons-img z-index-item-down Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-kozerog-active"></i>
                            <i class="horoscope-icons horoscope-icons-kozerog"></i>
                        </div>
                        <span>КОЗЕРОГ</span>
                    </div>
                </a>
                <a href="#aquarius" class="icons-img z-index-item-down Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-vodoley-active"></i>
                            <i class="horoscope-icons horoscope-icons-vodoley"></i>
                        </div>
                        <span>ВОДОЛЕЙ</span>
                    </div>
                </a>
                <a href="#pisces" class="icons-img z-index-item-down Top-link">
                    <div class="horo">
                        <div class="icon-wrap">
                            <i class="horoscope-icons horoscope-icons-riba-active"></i>
                            <i class="horoscope-icons horoscope-icons-riba"></i>
                        </div>
                        <span>РЫБЫ</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="main-content">
        @if(!empty($signs))
            @foreach($signs as $key=>$sign)
                <div class="horoscope-description">
                    <div class="horoscope-path">
                        <div class="img-horoscope-description">
                            <h4>{{ trans('admin.' . $key) }}</h4>
                            <img src="{{asset('estet')}}/img/horoscope/{{ $key }}-description.png" alt="">
                        </div>
                        <div id="{{ $key }}" class="description">
                            {{ $sign }}
                        </div>
                    </div>

                    <div class="horoscope-controller">
                        <span data-close="свернуть" data-open="развернуть" class="span-spoiler"></span>
                        <img src="{{asset('estet')}}/img/horoscope/ic_arrow_drop_down_.png" alt="">
                    </div>

                </div>
            @endforeach
        @endif
            @include('layouts.comments.comments_form', ['id' => 1, 'source' => 5, 'comments' => $comments])
        </div>

       {!! $sidebar !!}
    </div>
</section>

<!--section 2-->
<section id="section-2" class="articles">
    <div class="left-title left-title-planshet">
        <div class="line-container">
            <div class="vertical-line"></div>
            <h2>Самое популярное</h2>
        </div>
    </div>
    <div class="content">
        <!--articles-gray-->
        <div class="articles-horizontal">
            @foreach($bests as $article)
                <article>
                    <a class="link-img" href="{{ route('articles', $article->alias) }}" rel="nofollow">
                        <img src="{{asset('images') . '/article/small/' . $article->image->path}}" alt="">
                    </a>
                    <div class="title-time">
                        <a href="{{ route('article_cat', $article->category->alias) }}">{{ $article->category->name }}</a>
                        <time>
                            @if(strlen($article->created) < 6) <i class="icons icon-clock"></i> @endif
                            {{ $article->created }}
                        </time>
                    </div>
                    <a class="link-title" href="{{ route('articles', $article->alias) }}">
                        <h3>{{ str_limit($article->title, 72) }}</h3>
                    </a>
                </article>
                @if(!$loop->last)
                    <div class="line-vertical"></div>
                @endif
            @endforeach
        </div>
    </div>
</section>