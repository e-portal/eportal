<section id="section-1" class="meropryyatyya">
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
            <div class="button-subscribe">
                <a href="#"><i class="icon-subscribe"></i> Записаться на мероприятие</a>
            </div>
            <!--section 5-->
            <div class="text-meropryyatyya">
                {{ $event->description }}
            </div>
            <!--section 6-->
            <div class="slide-meropryyatyya">
                @foreach($event->slider as $slider)
                    <img src="{{ asset('/images/event/slider/main') . '/' . $slider->path }}"
                         alt="{{ $slider->alt }}" title="{{ $slider->title }}">
                @endforeach
            </div>
            <div class="meropryyatyya-data">
                {!! $event->content !!}
            </div>


            <div class="button-subscribe">
                <a href="#"><i class="icon-subscribe"></i> Записаться на мероприятие</a>
            </div>
            <!--section 7-3-->
            @include('layouts.comments_form', ['id' => $event->id, 'source' => 4])
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
                    @foreach($similars as $event)
                        <article>
                            <a class="link-img" href="{{ route('events', $event->alias) }}" rel="nofollow">
                                <img src="{{ asset('images\event\mini').'/'. $event->logo->path}}"
                                     alt="{{ $event->logo->alt }}"
                                     title="{{ $event->logo->title }}"
                                >
                            </a>
                            <div class="title-time">
                                <time>
                                    @if(strlen($event->created) < 6) <i class="icons icon-clock"></i> @endif
                                    {{ $event->created }}
                                </time>
                            </div>
                            <a class="link-title" href="{{ route('events', $event->alias) }}">
                                <h3>{{ $event->title }}</h3>
                            </a>
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