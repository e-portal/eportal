<!--section 1-->
<section id="section-1" class="events-section blog-page">
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
                            {!! Form::select('cat', [null => 'Категория', 0=>'Все'] + $cats, old('cat') ? : '') !!}
                        </label>
                        <label>
                            {!! Form::select('organizer', [null => 'Организатор'] + $organizer, old('organizer') ? : '') !!}
                        </label>
                        <div class="brands">
                            @if(!empty($children))
                                @foreach($children as $child)
                                    <input type="checkbox" id="id-{{ $child->id }}" data-organizer="{{ $child->id }}"
                                           name="{{ $child->id }}">
                                    <label for="id-{{ $child->id }}">{{ $child->name }}</label>
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
                {{--{{ dump($calendar) }}--}}
                <div class="calendar">
                    <!--slider-->
                    <div class="calendar-slider">
                        <div class="slides">
                        </div>
                        <div class="pagination">

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
                            @for($i = 1, $x=0; $i <= $calendar_vars['last_number']; $i++)
                                <div @if(1 === $i) class="{{ $calendar_vars['first'] }}" @endif >
                                    <span>{{ $i }}</span>

                                    @foreach($calendar as $event)

                                        @if(($i > $event->stop_date) || ($i < $event->start_date))
                                            @if($loop->last && (1 == $x))
                                </div>
                                <span>{{ $i }}</span>
                        </div>
                        <? $x = 0; ?>
                        @endif
                        @continue
                        @else
                            @if(0 == $x)
                                <div class="event-date">
                                    <div class="slides">
                                        <? $x = 1; ?>
                                        @endif
                                        <div class="slide active" data-organizer="{{ $event->id }}">
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
                                                <h4>{{ str_limit(($event->title ?? ''), 40) }}</h4>
                                                <div class="button-block">
                                                    <a href="{{ route('events', $event->alias) }}">Подробнее</a>
                                                </div>
                                            </figure>
                                        </div>

                                        @endif

                                        @if($loop->last)
                                    </div>
                                    <span>{{ $i }}</span>
                                </div>
                                <? $x = 0; ?>
                            @endif

                            @endforeach
                                </div>
                            @endfor
                        </div>
                    </div>
                    <!--day-numbers-->
                </div>
            </div>
            <!--current date-->
    <div class="current-date @if(empty($calendar[1])) not-found @endif">
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
        <span itemprop="name" class="label1">Мероприятия</span>
        <meta itemprop="position" content="2"/>
    </div>
</div>
{{--BreadCrumbs--}}