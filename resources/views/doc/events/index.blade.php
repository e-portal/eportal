<!--section 1-->
<section id="section-1" class="events-section">
    <div class="left-title">
        <div class="line-container">
            <div class="vertical-line"></div>
            <h2>Мероприятия</h2>
        </div>
    </div>
    <div class="content">
        <div class="main-content">
            <h3>Вы можете выбрать мероприятие по дате актуальности</h3>
            <!--form organizer-->
            <div class="form-organizer">
                {!! Form::open(['url'=>route('events'), 'method'=>'get']) !!}
                    <fieldset>
                        <legend>Выберите организатора</legend>
                        <label>
                            {!! Form::select('country', [null => 'Страна'] + $countries, old('country') ? : '', ['id'=>'country']) !!}
                        </label>
                        <label>
                            <select id="city" name="city">
                                <option value="" selected="selected">Город</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" data-country="{{ $city->country_id }}"
                                            @if(session('city') == $city->id)
                                            selected="selected"
                                            @endif
                                    >{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            {!! Form::select('cat', [null => 'Категория'] + $cats, old('cat') ? : '') !!}
                        </label>
                        <label>
                            {!! Form::select('organizer', [null => 'Организатор'] + $organizer, old('organizer') ? : '') !!}
                        </label>
                        <div class="brands">
                            @if(!empty($children))
                                @foreach($children as $child)
                                    {{--<a href="{{ route('events') }}/?country=&city=&cat=&organizer={{ $child->id }}">{{ $child->name }}</a>--}}
                                    <input type="checkbox" data-organizer="{{ $child->id }}" name="{{ $child->id }}">
                                    <label for="{{ $child->id }}">{{ $child->name }}</label>
                                @endforeach
                            @endif
                        </div>
                    </fieldset>
            </div>
            <!--calendar-->
            <div class="calendar-wrap">
                <label>
                    {!! Form::select('month',
                    [
                        1=>'Январь',
                        2=>'Февраль',
                        3=>'Март',
                        4=>'Апрель',
                        5=>'Май',
                        6=>'Июнь',
                        7=>'Июль',
                        8=>'Август',
                        9=>'Сентябрь',
                        10=>'Октябрь',
                        11=>'Ноябрь',
                        12=>'Декабрь',
                    ], old('month') ? : ($profile->month ?? '' ), [ 'placeholder'=>'Месяц'])
                !!}
                </label>
                <div class="year">
                    <label><input type="text" name="year" value="{{ $calendar_vars['year'] }}"></label>
                    <div class="year-choice">
                        <div class="top"></div>
                        <div class="bot"></div>
                    </div>
                </div>
                <button type="submit">Фильтровать</button>
                {!! Form::close() !!}
                {{ dump($calendar_vars) }}
                <div class="calendar">
                    <!--slider-->
                    <div class="calendar-slider">
                        <div class="slides">
                            <div class="slide active">
                                <img src="../img/events/slide-1.jpg" alt="">
                                <figure>
                                    <figcaption><span>Первый черноморский конгресс</span></figcaption>
                                    <div class="date">17 апреля</div>
                                    <div class="theme">тема мероприятия</div>
                                    <h4>Красота на кончике иглы</h4>
                                    <div class="button-block">
                                        <a href="#">Подробнее</a>
                                    </div>
                                </figure>
                            </div>
                            <div class="slide">
                                <img src="../img/events/slide-2.jpg" alt="">
                                <figure>
                                    <figcaption><span>Второй черноморский конгресс</span></figcaption>
                                    <div class="date">17 апреля</div>
                                    <div class="theme">тема мероприятия</div>
                                    <h4>Красота на кончике иглы2</h4>
                                    <div class="button-block">
                                        <a href="#">Подробнее</a>
                                    </div>
                                </figure>
                            </div>
                            <div class="slide">
                                <img src="../img/events/slide-3.jpg" alt="">
                                <figure>
                                    <figcaption><span>Третийй черноморский конгресс</span></figcaption>
                                    <div class="date">17 апреля</div>
                                    <div class="theme">тема мероприятия</div>
                                    <h4>Красота на кончике иглы3</h4>
                                    <div class="button-block">
                                        <a href="#">Подробнее</a>
                                    </div>
                                </figure>
                            </div>
                            <div class="slide">
                                <img src="../img/events/slide-4.jpg" alt="">
                                <figure>
                                    <figcaption><span>Четвертый черноморский конгресс</span></figcaption>
                                    <div class="date">17 апреля</div>
                                    <div class="theme">тема мероприятия</div>
                                    <h4>Красота на кончике иглы4</h4>
                                    <div class="button-block">
                                        <a href="#">Подробнее</a>
                                    </div>
                                </figure>
                            </div>
                        </div>
                        <div class="pagination">
                            <span class="to-left"><i class="icons icon-left"></i></span>
                            <span class="active"></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span class="to-right"><i class="icons icon-right"></i></span>
                        </div>
                        <div class="close">
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!--days-->
                    <div class="day-names">
                        <span>Пн</span>
                        <span>Вт</span>
                        <span>Ср</span>
                        <span>Чт</span>
                        <span>Пт</span>
                        <span>Сб</span>
                        <span>Вс</span>
                    </div>
                    <!--day-numbers-->
                    <div class="days-wrapper">
                        <div class="days" data-month="4" data-year="2017">
                            @for($i = 1; $i < $calendar_vars['last_number']; $i++)
                                <div @if(1 === $i) class="{{ $calendar_vars['first'] }}" @endif >
                                    <span>{{ $i }}</span>
                                    <div class="event-date">
                                        <div>
                                            <div class="slides">
                                                @foreach($calendar as $event)

                                                    @if(($i > $event->stop_date) || ($i < $event->start_date))
                                                        @continue
                                                    @else
                                                        <div class="slide active">
                                                            <img src="{{ asset('/images/event/mini') . '/' . $event->logo->path }}"
                                                                 alt="{{ $event->logo->alt }}"
                                                                 title="{{ $event->logo->title }}">
                                                            <figure>
                                                                <figcaption>
                                                                    <span>{{ str_limit(($event->short_title ?? ''), 32) }}</span>
                                                                </figcaption>
                                                                <div class="date">
                                                                    {{ $i . ' ' . trans('ru.m' . date($calendar_vars['month'])) . ' ' . date($calendar_vars['year']) }}
                                                                </div>
                                                                <div class="theme">тема мероприятия</div>
                                                                <h4>{{ str_limit(($event->short_title ?? ''), 48) }}</h4>
                                                                <div class="button-block">
                                                                    <a href="{{ route('events', $event->alias) }}">Подробнее</a>
                                                                </div>
                                                            </figure>
                                                        </div>

                                                    @endif

                                                @endforeach
                                            </div>
                                            <span>3</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <!--day-numbers-->
                </div>
            </div>
            <!--current date-->
            <div class="current-date">
                @if(empty($calendar[1]))
                    <span>К сожалению, по указанным Вами критериям ничего не найдено. Ближайшие мероприятия смотрите ниже:</span>
                @else
                    <span>Все мероприятия</span>
                @endif
            </div>
            <!--articles-->
            <div class="articles-wrap">
                @if(!empty($prems))
                    @foreach($prems as $prem)
                        <div class="article premium">
                            <div class="article-content">
                                <div class="article-content_top">
                                    <a href="{{ route('events', $prem->alias) }}">
                                        <img src="{{ asset('/images/event/middle') . '/' . $prem->logo->path }}"
                                             alt="{{ $prem->alt }}" title="{{ $prem->title }}">
                                    </a>
                                    <div>
                                        <h4><span>{{ $prem->short_title ?? str_limit($prem->title, 32) }}</span></h4>
                                        <p>{{ str_limit($prem->description, 312) }}</p>
                                    </div>
                                </div>
                                <div class="button-block" data-id="{{ $prem->id }}">
                                    @if(!empty($prem->extlink))
                                        <a href="{{ $prem->extlink }}">
                                            <i class="icon-subscribe"></i> Записаться на мероприятие
                                        </a>
                                    @elseif(!empty($prem->extmail))
                                        <a class="js-pop"><i class="icon-subscribe"></i> Записаться на мероприятие</a>
                                    @endif
                                    <div class="button-line"></div>
                                    <a href="{{ route('events', $prem->alias) }}">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            <!--insert aside-->
                {{--<aside class="aside">
                    <div class="aside-block">
                        <div class="advertising">
                            <img src="../img/advertising.jpg" alt="">
                        </div>
                    </div>
                    <div class="aside-block">
                        <div class="form-wrap">
                            <form>
                                <h4 class="form-title">Будь в курсе последних новостей</h4>
                                <strong>подпишись на рассылку</strong>
                                <label><input type="email" placeholder="ваша почта"></label>
                                <label>
                                    <select name="type">
                                        <option selected="selected" value="0">я врач</option>
                                        <option value="1">я пациент</option>
                                    </select>
                                </label>
                                <label>
                                    <select name="type">
                                        <option selected="selected" value="0">я дерматолог</option>
                                        <option value="1">я врач</option>
                                    </select>
                                </label>
                                <button class="pod-subs pod-purpur" type="button">Подписаться</button>
                            </form>
                        </div>
                    </div>
                </aside>--}}
            <!--continue main content-->
                @if(!empty($events))
                    @foreach($events as $event)
                        <div class="article">
                            <div class="article-content">
                                <div class="article-content_top">
                                    <a href="{{ route('events', $prem->alias) }}">
                                        <img src="{{ asset('/images/event/middle') . '/' . $event->logo->path }}"
                                             alt="{{ $event->alt }}" title="{{ $event->title }}">
                                    </a>
                                    <div>
                                        <h4><span>{{ $event->short_title ?? str_limit($event->title, 32) }}</span></h4>
                                        <p>{{ str_limit($event->description, 312) }}</p>
                                    </div>
                                </div>
                                <div class="button-block" data-id="{{ $event->id }}">
                                    @if(!empty($event->extlink))
                                        <a href="{{ $event->extlink }}">
                                            <i class="icon-subscribe"></i> Записаться на мероприятие
                                        </a>
                                    @elseif(!empty($event->extmail))
                                        <a class="js-pop"><i class="icon-subscribe"></i> Записаться на мероприятие</a>
                                    @endif
                                    <div class="button-line"></div>
                                    <a href="{{ route('events', $event->alias) }}">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!--aside block-->
        {!! $sidebar !!}
        @if(is_object($events) && !empty($events->lastPage()) && $events->lastPage() > 1)
            <div class="pagination content-blog">
                <!--PAGINATION-->
                <div class="pagination-blog">
                    @if($events->lastPage() > 1)
                        <ul>
                            @if($events->currentPage() !== 1)
                                <li>
                                    <a rel="prev" href="{{ $events->url(($events->currentPage() - 1)) }}" class="prev">
                                        <
                                    </a>
                                </li>
                            @endif
                            @if($events->currentPage() >= 3)
                                <li><a href="{{ $events->url($events->lastPage()) }}">1</a></li>
                            @endif
                            @if($events->currentPage() >= 4)
                                <li><a href="#">...</a></li>
                            @endif
                            @if($events->currentPage() !== 1)
                                <li>
                                    <a href="{{ $events->url($events->currentPage()-1) }}">{{ $events->currentPage()-1 }}</a>
                                </li>
                            @endif
                            <li><a class="active disabled">{{ $events->currentPage() }}</a></li>
                            @if($events->currentPage() !== $events->lastPage())
                                <li>
                                    <a href="{{ $events->url($events->currentPage()+1) }}">{{ $events->currentPage()+1 }}</a>
                                </li>
                            @endif
                            @if($events->currentPage() <= ($events->lastPage()-3))
                                <li><a href="#">...</a></li>
                            @endif
                            @if($events->currentPage() <= ($events->lastPage()-2))
                                <li><a href="{{ $events->url($events->lastPage()) }}">{{ $events->lastPage() }}</a>
                                </li>
                            @endif
                            @if($events->currentPage() !== $events->lastPage())
                                <li>
                                    <a rel="next" href="{{ $events->url(($events->currentPage() + 1)) }}" class="next">
                                        >
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>


{{--<div class="row w-100 bg-info">
    {!! Form::open(['url'=>route('events'), 'method'=>'get', 'class'=>'form-horizontal']) !!}
    <div class="text-center">Выберите организатора</div>
    <div class="row">
        <div class="col-lg-4">
            {{ Form::label('country', 'Выбрать страну') }}
            {!! Form::select('country', [null => 'Страна'] + $countries, old('country') ? : '', ['class'=>'form-control']) !!}
        </div>
        <div class="col-lg-4">
            {{ Form::label('city', 'Выбрать город') }}
            <select id="city" name="city" class="form-control">
                <option value="" selected="selected">Город</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" data-country="{{ $city->country_id }}"
                            @if(session('city') == $city->id)
                            selected="selected"
                            @endif
                    >{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4">
            {{ Form::label('cat', 'Выбрать категорию') }}
            {!! Form::select('cat', [null => 'Категория'] + $cats, old('cat') ? : '', ['class'=>'form-control']) !!}
        </div>
        <hr>
    </div>
    <hr>
    <div>
        {{ Form::label('organizer', 'Выбрать организатора') }}
        {!! Form::select('organizer', [null => 'Организатор'] + $organizer, old('organizer') ? : '', ['class'=>'form-control']) !!}
    </div>
    <hr>
    @if(!empty($children))
        @foreach($children as $child)
            <a href="{{ route('events') }}/?country=&city=&cat=&organizer={{ $child->id }}">{{ $child->name }}</a>
        @endforeach
    @endif
    <hr>
    {!! Form::button('Поиск', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
    <hr>
    {!! Form::close() !!}
</div>
<div class="row">
    @for($i = 1; $i < $calendar_vars['last_number']; $i++)
        @foreach($calendar as $event)
            --}}{{--{{ dump($event) }}--}}{{--
            @if(($i > $event->stop_date) || ($i < $event->start_date))
                @continue
            @else
                <div @if($loop->first)class="{{ $calendar_vars['first'] }}"@endif>{{ $i . ' ' . $event->title }}</div>
            @endif--}}{{--
            @if($loop->last)
                <div class="{{ date('D', mktime(0, 0, 0, date('m'), $i, date('Y'))) }}"></div>
            @endif--}}{{--
            --}}{{--@break--}}{{--
        @endforeach
    @endfor

</div>
--}}{{--Premuim--}}{{--
<div class="row">
    @if(!empty($prems))
        @foreach($prems as $prem)
            <div class="row bg-warning">
                <div class="col-lg-4">
                    {{ Html::image(asset('/images/event/main') . '/' . $prem->logo->path, $prem->title, array('class' => 'img-thumbnail')) }}
                </div>
                <div class="col-lg-8">
                    <h3>{{ $prem->title }}</h3>
                    <p>{!! str_limit($prem->description, 254) !!}</p>
                    <hr>
                    <p>
                        {!! Form::open(['url' => route('events',['event_alias'=> $prem->alias]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button(trans('ru.more'), ['class' => 'btn btn-basic','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </p>
                </div>
            </div>
            <hr>
        @endforeach
    @endif
</div>
--}}{{--Premuim--}}{{--
<div class="row">
    @if(!empty($events))
        @foreach($events as $event)
            <div class="row">
                <div class="col-lg-4">
                    {{ Html::image(asset('/images/event/main') . '/' . $event->logo->path, $event->title, array('class' => 'img-thumbnail')) }}
                </div>
                <div class="col-lg-8">
                    <h3>{{ $event->title }}</h3>
                    <p>{!! str_limit($event->description, 254) !!}</p>
                    <hr>
                    <p>
                        {!! Form::open(['url' => route('events',['event_alias'=> $event->alias]),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button(trans('ru.more'), ['class' => 'btn btn-basic','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </p>
                </div>
            </div>
            <hr>
        @endforeach
    @endif
</div>
<!--PAGINATION-->
<div class="general-pagination group">
    @if($events->lastPage() > 1)
        <ul class="pagination">
            @if($events->currentPage() !== 1)
                <li><a href="{{ $events->url(($events->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a></li>
            @endif

            @for($i = 1; $i <= $events->lastPage(); $i++)
                @if($events->currentPage() == $i)
                    <li><a class="active disabled">{{ $i }}</a></li>
                @else
                    <li><a href="{{ $events->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            @if($events->currentPage() !== $events->lastPage())
                <li><a href="{{ $events->url(($events->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a></li>
            @endif
        </ul>
    @endif
</div>--}}
