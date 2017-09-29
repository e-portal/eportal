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
        <!-- section 2 -->
        <div class="bread-crumbss">
            <div itemscope itemtype="#">
                <a itemprop="url">
                    <span itemprop="title">Врачи</span>
                </a>
            </div>
            <div itemscope itemtype="#">
                <span itemprop="title"></span>
            </div>
        </div>
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
                                        <a href="{{ route('profiles',['profile'=> $prem->alias]) }}" rel="nofollow">
                                            <img src="{{ asset('/images/establishment/small') . '/' . $prem->logo  }}"
                                                 alt="{{ $prem->alt ?? '' }}" title="{{ $prem->imgtitle ?? '' }}">
                                        </a>
                                        <div>
                                            <h4>
                                                <span>{{ ($prem->name ?? '') . ' ' . ($prem->lastname ?? '')}}</span>
                                            </h4>
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
                                        <a href="{{ route('profiles',['profile'=> $prem->alias]) }}">
                                            Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{--premium--}}
                    {{--profiles--}}
                    @if(!empty($profiles))
                        @foreach($profiles as $profile)
                            <div class="article">
                                <div class="article-content">
                                    <div class="article-content_top">
                                        <a href="{{ route('docs',['profile'=> $profile->alias]) }}" rel="nofollow">
                                            <img src="{{ asset(config('settings.theme'))  . '/img/profile/main/' . ($profile->photo ?? '../no_photo.jpg') }}"
                                                 alt="{{ $profile->alt ?? '' }}" title="{{ $profile->imgtitle ?? '' }}">
                                        </a>
                                        <div>
                                            <h4>
                                                <span>{{ ($profile->name ?? '') . ' ' . ($profile->lastname ?? '')}}</span>
                                            </h4>
                                            <p>
                                                @if(!empty($profile->description))
                                                    {{ $profile->description }}
                                                @else
                                                    {!! str_limit($profile->content, 254) !!}
                                                @endif
                                            </p>
                                            <hr>
                                            <span>
                                                @if(!empty($profile->job))
                                                    {{ $profile->job ?? ''}}
                                                @endif
                                                <br>
                                                {{ $profile->address }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <div class="button-line"></div>
                                        <a href="{{ route('docs',['profile'=> $profile->alias]) }}">
                                            Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{--profiles--}}
                    <hr>
                    <div class="pagination content-blog">
                        <!--PAGINATION-->
                        <div class="pagination-blog">
                            @if(is_object($profiles) && !empty($profiles->lastPage()) && $profiles->lastPage() > 1)
                                <ul>
                                    @if($profiles->currentPage() !== 1)
                                        <li>
                                            <a rel="prev" href="{{ $profiles->url(($profiles->currentPage() - 1)) }}"
                                               class="prev">
                                                <
                                            </a>
                                        </li>
                                    @endif
                                    @if($profiles->currentPage() >= 3)
                                        <li><a href="{{ $profiles->url($profiles->lastPage()) }}">1</a></li>
                                    @endif
                                    @if($profiles->currentPage() >= 4)
                                        <li><a href="#">...</a></li>
                                    @endif
                                    @if($profiles->currentPage() !== 1)
                                        <li>
                                            <a href="{{ $profiles->url($profiles->currentPage()-1) }}">{{ $profiles->currentPage()-1 }}</a>
                                        </li>
                                    @endif
                                    <li><a class="active disabled">{{ $profiles->currentPage() }}</a></li>
                                    @if($profiles->currentPage() !== $profiles->lastPage())
                                        <li>
                                            <a href="{{ $profiles->url($profiles->currentPage()+1) }}">{{ $profiles->currentPage()+1 }}</a>
                                        </li>
                                    @endif
                                    @if($profiles->currentPage() <= ($profiles->lastPage()-3))
                                        <li><a href="#">...</a></li>
                                    @endif
                                    @if($profiles->currentPage() <= ($profiles->lastPage()-2))
                                        <li>
                                            <a href="{{ $profiles->url($profiles->lastPage()) }}">{{ $profiles->lastPage() }}</a>
                                        </li>
                                    @endif
                                    @if($profiles->currentPage() !== $profiles->lastPage())
                                        <li>
                                            <a rel="next" href="{{ $profiles->url(($profiles->currentPage() + 1)) }}"
                                               class="next">
                                                >
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
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
        <span itemprop="name" class="label1">Врачи</span>
        <meta itemprop="position" content="2"/>
    </div>
</div>
{{--BreadCrumbs--}}