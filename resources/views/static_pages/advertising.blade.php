<div class="title-main ">
    <p class="heading-title">
    <h2>{{ $advertising->title }}</h2>
    </p>
</div>
<!--section 1-->
<section id="section-1" class="horoscope">
    <div class="left-title left-title-planshet">
        <div class="line-container text-vertical">
            <div class="vertical-line"></div>
            <h2>Реклама</h2>
        </div>
    </div>

    <div class="content content-vnutrennaya">
        <div class="main-content">
            <div class="content-centr">
                <div class="main-img-info">
                    <div class="images">
                        {!! $advertising->text !!}
                    </div>
                </div>
            </div>
        </div>
        {!! $sidebar !!}
    </div>
</section>