<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(!empty($seo->seo_keywords))
        <meta name="keywords" content="{{ $seo->seo_keywords }}">
    @endif
    @if(!empty($seo->seo_description))
        <meta name="description" content="{{ $seo->seo_description }}">
    @endif
    @if(!empty($seo->og_title))
        <meta property="og:title" content="{{ $seo->og_title }}"/>
    @endif
    @if(!empty($seo->og_description))
        <meta property="og:description" content="{{ $seo->og_description }}"/>
    @endif
    <meta property="og:url" content="{{ url()->current() }}"/>
    @if(!empty($seo->og_image))
        <meta property="og:image" content="{{ $seo->og_image }}"/>
    @endif
    <title>
        @if(!empty($seo->seo_title))
            {{ $seo->seo_title . ' - ' . env('APP_NAME') }}
        @else
            {{ $title ? ($title.' - '. env('APP_NAME')) : env('APP_NAME') }}
        @endif
    </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/base.css">
    @if(!empty($css))
        {!! $css !!}
    @endif
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/fonts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/pop-up.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Vidaloka" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:400,600i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:700&amp;subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
            rel="stylesheet">
</head>
<body>
@if(session()->has('doc'))
    <div class="wrapper doctor-page">
@else
    <div class="wrapper">
@endif
    <div class="w-block"></div>
    <!--menu mobal-->
    <header>
        <div class="container-fool">
            <div class="container">
                @yield('navbar')
            </div>
        </div>
    </header>
    <div class="container">
        @if(!empty($title_img))
            <h1>
                @if(session()->has('doc'))
                    {!! ('doctors' == Route::currentRouteName()) ?
                            '<img src="'. asset('estet') .'/img/title.png" alt="'. env('APP_NAME') .'"
                                title="'. env('APP_NAME') .'">'
                                 :
                            '<a href="'. route('doctors') .'">
                                <img src="'. asset('estet') .'/img/title.png" alt="'. env('APP_NAME') .'"
                                    title="'. env('APP_NAME') .'"></a>'
                     !!}
                @else
                    {!! ('main' == Route::currentRouteName()) ?
                            '<img src="'. asset('estet') .'/img/title.png" alt="'. env('APP_NAME') .'"
                                title="'. env('APP_NAME') .'">'
                                 :
                            '<a href="'. route('main') .'">
                                <img src="'. asset('estet') .'/img/title.png" alt="'. env('APP_NAME') .'"
                                    title="'. env('APP_NAME') .'"></a>'
                     !!}
                @endif
            </h1>
        @endif

        @yield('content')

        <div class="wrap-top-top">
            <div class="to-top"></div>
            наверх
        </div>
        <!---------------------------------------------seo text start------------------------------------->
    @if(!empty($seo->seo_text) && ('main' !== Route::currentRouteName()) && ('doctors' !== Route::currentRouteName()))
        {!! $seo->seo_text !!}
    @endif
    <!---------------------------------------------seo text stop------------------------------------->
    </div>
        @yield('footer')
</div>
            <!--pop-->
            <div class="wrap-pop">
                <div class="pop-bg"></div>
                <div class="pop-up to-page-doctor">
                    <div class="pop-inner">
                        <div class="line"></div>
                        <div class="pop-inner-in">
                            <h1 class="own">Я врач</h1>
                            <p>Соглашаясь просматривать материалы раздела, я подтверждаю, что являюсь дипломированным
                                специалистом</p>
                        {{--temp--}}
                        @if(!session()->has('doc'))
                            {!! Form::open(['url' => route('switch'), 'method'=>'POST']) !!}
                            {!! Form::hidden('doc', true) !!}
                                <button class="btn btn-info" type="submit"><span>ПРОДОЛЖИТЬ ПРОСМОТР</span></button>
                                <div class="remember-me"><input id="checkBox" name="remember" value="remember"
                                                                type="checkbox"><label class="label" for="checkBox">Запомнить
                                        меня</label></div>
                                <div class="close-pop">НАЗАД</div>
                                <div class="line"></div>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['url' => route('switch'), 'method'=>'POST']) !!}
                            {!! Form::hidden('patient', true) !!}
                                <button class="btn btn-info" type="submit"><span>ПРОДОЛЖИТЬ ПРОСМОТР</span></button>
                                <div class="remember-me"><input id="checkBox" name="remember" value="remember"
                                                                type="checkbox"><label class="label" for="checkBox">Запомнить
                                        меня</label></div>
                                <div class="close-pop">НАЗАД</div>
                                <div class="line"></div>
                            {!! Form::close() !!}
                        @endif
                        {{--temp--}}
                    </div>
                </div>
            </div>
            </div>
            <div class="background-menu-active"></div>
            <!--end pop-->
<!-- end wraperr -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ asset('js') }}/libs/slick.min.js"></script>
<script src="{{ asset('js') }}/menu.js"></script>
            @if(!empty($js))
                {!! $js !!}
            @endif
            <script src="{{ asset('js') }}/animations.js"></script>
</body>
</html>