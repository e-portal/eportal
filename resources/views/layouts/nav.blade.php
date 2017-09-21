@if ($menu)
    <nav>
        <div class="burger">
            <div class="line-burger"></div>
            <div class="line-burger"></div>
            <div class="line-burger"></div>
        </div>
        <div class="menu-left">
            <div class="person patient menu-elem active">
                <a href="{{ route('main') }}">Я пациент</a>
            </div>

            <div id="toggles" class="toggles">
                <input type="checkbox" name="checkbox1" id="checkbox1"
                       class="ios-toggle @if(!(session()->has('doc'))) active @endif"/>
                <label for="checkbox1" class="checkbox-label"></label>
            </div>
            <div class="person doctor menu-elem">Я врач</div>
        </div>

        <div class="header-menu-left">
            <div class="nav_container">
                <ul id="main-menu" class="menu">
                    <li class="menu-elem main-page">
                        <a href="{{ route('main') }}">
                            <img src="{{ asset('estet') }}/img/menu/6489.png">
                            <img src="{{ asset('estet') }}/img/menu/6489.png">
                            <span>Главная</span>
                        </a>
                    </li>
                    <li class="with-sub menu-elem">
                        <a>
                            <img src="{{ asset('estet') }}/img/menu/1.png"><img
                                    src="{{ asset('estet') }}/img/menu/2074.png">
                            <span>Статьи</span>
                        </a>
                        <ul class="submenu">
                            <li class="col">
                                {!! Menu::get('menu')->asUl() !!}
                            </li>
                        </ul>
                    </li>
                    @if(session()->has('doc'))
                        <li class="menu-elem">
                            <a href="{{ route('events') }}">
                                <img src="{{ asset('estet') }}/img/menu/1_901464.png">
                                <img src="{{ asset('estet') }}/img/menu/901464.png">
                                <span>Мероприятия</span>
                            </a>
                        </li>
                        <li class="menu-elem">
                            <a href="{{ route('blogs') }}">
                                <img src="{{ asset('estet') }}/img/menu/1_2089.png">
                                <img src="{{ asset('estet') }}/img/menu/2089.png">
                                <span>Блог</span>
                            </a>
                        </li>
                        <li class="menu-elem">
                            <a href="{{ route('docs_cat', 'praktika') }}">
                                <img src="{{ asset('estet') }}/img/menu/1_840.png">
                                <img src="{{ asset('estet') }}/img/menu/840.png">
                                <span>Практика</span>
                            </a>
                        </li>
                        <li class="menu-elem"><a href="{{ route('docs_cat', 'video') }}">
                                <img src="{{ asset('estet') }}/img/menu/3.png"><img
                                        src="{{ asset('estet') }}/img/menu/2075.png">
                                <span>Видео</span></a></li>
                    @else
                        <li class="menu-elem"><a href="{{ route('article_cat', 'video') }}">
                                <img src="{{ asset('estet') }}/img/menu/3.png"><img
                                        src="{{ asset('estet') }}/img/menu/2075.png">
                                <span>Видео</span></a></li>
                        <li class="menu-elem">
                            <a href="{{ route('article_cat', 'intervyu') }}">
                                <img src="{{ asset('estet') }}/img/menu/2.png">
                                <img src="{{ asset('estet') }}/img/menu/1_2.png">
                                <span>Интервью</span>
                            </a></li>
                    @endif
                    <li class="with-sub menu-elem"><a>
                            <img src="{{ asset('estet') }}/img/menu/4.png">
                            <img src="{{ asset('estet') }}/img/menu/837.png">
                            <span>Каталог</span></a>
                        <ul class="submenu">
                            <li class="col">
                                <ul>
                                    <li><a href="{{ route('docs') }}">Врачи</a></li>
                                    <li><a href="{{ route('clinics') }}">Клиники</a></li>
                                    <li><a href="{{ route('distributors') }}">Дистрибьюторы</a></li>
                                    <li><a href="{{ route('brands') }}">Бренды</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="with-sub menu-elem last-elem">
                        <a>
                            <img src="{{ asset('estet') }}/img/menu/5.png">
                            <img src="{{ asset('estet') }}/img/menu/845.png">
                            <span>Еще</span>
                        </a>
                        <ul class="submenu">
                            <li class="col">
                                <ul>
                                    <li><a href="{{ route('about') }}">О проекте</a></li>
                                    <li><a href="{{ route('advertising') }}">Реклама</a></li>
                                    <li><a href="{{ route('contacts') }}">Обратная связь</a></li>
                                    <li><a href="{{ route('sitemap') }}">Карта сайта</a></li>
                                    <li><a href="{{ route('conditions') }}">Соглашение об использовании</a></li>
                                    <li><a href="{{ route('partnership') }}">Партнерство</a></li>
                                    <li><a href="{{ route('article_cat', 'video-otzyvy' ) }}">Видео отзывы</a></li>
                                </ul>

                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="memu-search menu-elem">
                <div class="search-mobb ">
                    <form>
                        <input class="search-mob" type="search" name="q" placeholder="Искать...">
                    </form>
                </div>
                <div class="search" id="search"><img src="{{ asset('estet') }}/img/menu/search.png"></div>
            </div>
        </div>
    </nav>
@endif