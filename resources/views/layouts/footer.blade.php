<footer>
    <div class="footer-top">
        <div class="left">
            <h2 class="footer-head">
                @if (session()->has('doc'))
                    {!!
                        ('doctors' == Route::currentRouteName()) ?
                            '<img src="'. asset('estet') .'/img/footer/logo.png">'
                        :
                            '<a href="'. route('doctors') .'"><img src="'. asset('estet') .'/img/footer/logo.png"></a>'
                     !!}
                @else
                    @if(('main' === Route::currentRouteName()))
                        <img src="{{ asset('estet') }}/img/footer/logo.png">
                    @else
                        <a href="{{ route('main') }}"><img src="{{ asset('estet') }}/img/footer/logo.png"></a>
                    @endif
                @endif
            </h2>
            <div class="social-wrap">
                <h5>мы в соц. сетях</h5>
                <div class="social">
                    <a href="https://www.facebook.com/EstetPortalProf/" target="_blank" rel="nofollow"><img
                                src="{{ asset('estet') }}/img/footer/lg/facebook.svg"></a>
                    <a href="https://www.youtube.com/user/stesthetic/" target="_blank" rel="nofollow"><img
                                src="{{ asset('estet') }}/img/footer/lg/youtube.svg"></a>
                    <a href="https://twitter.com/Pro_Estet" target="_blank" rel="nofollow"><img
                                src="{{ asset('estet') }}/img/footer/lg/twitter.svg"></a>
                    <a href="http://vk.com/estetportal" target="_blank" rel="nofollow"><img
                                src="{{ asset('estet') }}/img/footer/lg/vk.svg"></a>
                    <a href="http://ok.ru/estetportal" target="_blank" rel="nofollow"><img
                                src="{{ asset('estet') }}/img/footer/lg/odnoklasniki.svg"></a>
                    <a href="https://plus.google.com/+Эстетическаямедицина" target="_blank" rel="nofollow"><img
                                src="{{ asset('estet') }}/img/footer/lg/google.svg"></a>
                    <a href="https://www.instagram.com/Estet_portal" target="_blank" rel="nofollow"><img
                                src="{{ asset('estet') }}/img/footer/lg/insta.svg"></a>
                </div>
            </div>
        </div>
        <div class="center">
            <p>Все материалы созданы и подготовлены для некоммерческих и образовательных целей посетителей Портала.
                Мнение
                редакции не всегда совпадает с мнением авторов. При цитировании или копировании любой информации
                обязательно
                должна быть указана ссылка на estet-portal.com как источник.</p>
            <p>© 2011–2017 Все права защищены. За материалы, предоставленные на правах рекламы, ответственность несёт
                рекламодатель. Запрещается копирование статей и других объектов права интеллектуальной собственности
                сайта
                www.estet-portal.com без указания прямой, видимой и индексируемой поисковыми системами ссылки
                непосредственно
                над или под источником контента.</p>
        </div>
        <div class="right">
            <div class="footer-ad">
                @if(!empty($adv->text))
                    {!! $adv->text !!}
                @else
                    <img src="{{ asset("estet") }}/bannera/331x286.png">
                @ENDIF
            </div>
        </div>
    </div>
    <div class="footer-bot">
        <div class="left">
            <a href="https://itunes.apple.com/us/app/fitface/id566417059?mt=8">
                <img class="app-store" src="{{ asset('estet') }}/img/footer/app.png">
            </a>
        </div>
        <div class="center">
            <div class="footer-menu">
                <div>
                    @if('about' !== Route::currentRouteName())
                        <a href="{{ route('about') }}">О ПРОЕКТЕ</a>
                    @endif
                    @if('advertising' !== Route::currentRouteName())
                        <a href="{{ route('advertising') }}">РЕКЛАМА</a>
                    @endif
                    @if('contacts' !== Route::currentRouteName())
                        <a href="{{ route('contacts') }}">ОБРАТНАЯ СВЯЗЬ</a>
                    @endif
                    @if('sitemap' !== Route::currentRouteName())
                        <a href="{{ route('sitemap') }}">КАРТА САЙТА</a>
                    @endif
                </div>
                <div>
                    @if('conditions' !== Route::currentRouteName()) <a href="{{ route('conditions') }}">СОГЛАШЕНИЕ ОБ
                        ИСПОЛЬЗОВАНИИ</a> @endif
                    @if('partnership' !== Route::currentRouteName())
                        <a href="{{ route('partnership') }}">ПАРТНЕРСТВО</a>
                    @endif
                    @if('article_cat' !== Route::currentRouteName())
                        <a href="{{ route('article_cat', 'video-otzyvy' ) }}">ВИДЕО ОТЗЫВЫ</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="right">
            <div class="partner">
                <a target="_blank" href="https://econet.ua/">
                    <span>партнер</span>
                    <span>ECONET</span>
                </a>
            </div>

            <!--  <a target="_blank" href="https://freshweb.agency?utm_source=ESTET-PORTAL">
                 <span>разработка</span>
                 <span>FRESH</span>
             </a> -->
            <div class="fresh">
                <div class="created">САЙТ РАЗРАБОТАН</div>
                <a href="http://freshweb.agency/?utm_source=our-sites&utm_medium=estet" target="_blank">
                    <div class="fresh-logo"><span>F</span><span>R</span><span>E</span><span>S</span><span>H</span></div>
                </a>
                <div class="creative">CREATIVE WEB AGENCY</div>
            </div>


        </div>
    </div>
</footer>