@extends('/../layouts/admin')

@section('navbar')
    @if ($nav)
        <div class="navbar-header">
            {!! Menu::get('adminMenu')->asUl(array('class' => 'nav nav-pills')) !!}
        </div>
    @endif
@endsection

@section('content')
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('eventcats_admin') }}">Категории</a></li>
                <li><a href="{{ route('organizers_admin') }}">Организаторы</a></li>
                <li><a href="{{ route('create_event') }}">Создание мероприятия</a></li>
                <li><a href="{{ route('create_events_slider') }}">Рекламный слайдер</a></li>
                @if(Gate::allows('UPDATE_GEO'))
                    <li><a href="{{ route('country') }}">Добавить страну</a></li>
                @endif
                @if(Gate::allows('UPDATE_GEO'))
                    <li><a href="{{ route('city') }}">Добавить город</a></li>
                @endif
            </ul>
        </div>
    </nav>
    {!! $content !!}
@endsection