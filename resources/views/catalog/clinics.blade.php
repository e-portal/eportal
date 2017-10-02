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
        <div class="bread-crumbss">
            <div itemscope itemtype="#">
                <a itemprop="url">
                    <span itemprop="title">Клиники</span>
                </a>
            </div>
            <div itemscope itemtype="#">
                <span itemprop="title"></span>
            </div>
        </div>
        <!-- section 2 -->
        <div class="katalog-page">

            <div class="main-content page-content">
                <!-- section-3 -->
            @include('catalog.nav')
            <!-- section-4 -->
                <div class="articles-wrap">
                    {{--premium--}}

                    @if(!empty($prems))
                        @foreach($prems as $prem)
                            <div class="article premium">
                                <div class="article-content">
                                    <div class="article-content_top">
                                        <a href="{{ route('clinics',['clinic'=> $prem->alias]) }}" rel="nofollow">
                                            <img src="{{ asset('/images/establishment/small') . '/' . $prem->logo  }}"
                                                 alt="{{ $prem->alt ?? '' }}" title="{{ $prem->imgtitle ?? '' }}">
                                        </a>
                                        <div>
                                            <h4><span>{{ str_limit($prem->title, 32) }}</span></h4>
                                            <p>
                                                @if(!empty($prem->description))
                                                    {{ $prem->description }}
                                                @else
                                                    {!! str_limit($prem->content, 254) !!}
                                                @endif
                                            </p>
                                            <hr>
                                            <span>{{ $prem->address }}</span>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <div class="button-line"></div>
                                        <a href="{{ route('clinics',['clinic'=> $prem->alias]) }}">
                                            Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{--premium--}}
                    {{--clinics--}}
                    @if(!empty($clinics))
                        @foreach($clinics as $clinic)
                            <div class="article">
                                <div class="article-content">
                                    <div class="article-content_top">
                                        <a href="{{ route('clinics',['clinic'=> $clinic->alias]) }}" rel="nofollow">
                                            <img src="{{ asset('/images/establishment/main') . '/' . $clinic->logo }}"
                                                 alt="{{ $clinic->alt ?? '' }}" title="{{ $clinic->imgtitle ?? '' }}">
                                        </a>
                                        <div>
                                            <h4><span>{{ str_limit($clinic->title, 32) }}</span></h4>
                                            <p>
                                                @if(!empty($clinic->description))
                                                    {{ $clinic->description }}
                                                @else
                                                    {!! str_limit($clinic->content, 254) !!}
                                                @endif
                                            </p>
                                            <hr>
                                            <span>{{ $clinic->address }}</span>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <div class="button-line"></div>
                                        <a href="{{ route('clinics',['clinic'=> $clinic->alias]) }}">
                                            Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{--clinics--}}
                    @if(is_object($clinics) && !empty($clinics->lastPage()) && $clinics->lastPage() > 1)
                    <!--PAGINATION-->
                        <hr>
                        <div class="pagination content-blog">
                        <div class="pagination-blog">
                                <ul>
                                    @if($clinics->currentPage() !== 1)
                                        <li>
                                            <a rel="prev" href="{{ $clinics->url(($clinics->currentPage() - 1)) }}"
                                               class="prev">
                                                <
                                            </a>
                                        </li>
                                    @endif
                                    @if($clinics->currentPage() >= 3)
                                        <li><a href="{{ $clinics->url(1) }}">1</a></li>
                                    @endif
                                    @if($clinics->currentPage() >= 4)
                                        <li><a href="#">...</a></li>
                                    @endif
                                    @if($clinics->currentPage() !== 1)
                                        <li>
                                            <a href="{{ $clinics->url($clinics->currentPage()-1) }}">{{ $clinics->currentPage()-1 }}</a>
                                        </li>
                                    @endif
                                    <li><a class="active disabled">{{ $clinics->currentPage() }}</a></li>
                                    @if($clinics->currentPage() !== $clinics->lastPage())
                                        <li>
                                            <a href="{{ $clinics->url($clinics->currentPage()+1) }}">{{ $clinics->currentPage()+1 }}</a>
                                        </li>
                                    @endif
                                    @if($clinics->currentPage() <= ($clinics->lastPage()-3))
                                        <li><a href="#">...</a></li>
                                    @endif
                                    @if($clinics->currentPage() <= ($clinics->lastPage()-2))
                                        <li>
                                            <a href="{{ $clinics->url($clinics->lastPage()) }}">{{ $clinics->lastPage() }}</a>
                                        </li>
                                    @endif
                                    @if($clinics->currentPage() !== $clinics->lastPage())
                                        <li>
                                            <a rel="next" href="{{ $clinics->url(($clinics->currentPage() + 1)) }}"
                                               class="next">
                                                >
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        {!! $sidebar !!}
    </div>
</section>
{{--BreadCrumbs--}}
<div class="bread-crumbs" id="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <a href="{{ route('main') }}" itemprop="item">
            <span itemprop="name" class="label1">Главная</span>
            <meta itemprop="position" content="1"/>
        </a>
    </div>
    /
    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
        <span itemprop="name" class="label1">Клиники</span>
        <meta itemprop="position" content="2"/>
    </div>
</div>
{{--BreadCrumbs--}}