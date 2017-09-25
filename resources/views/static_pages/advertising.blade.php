<div class="title-main more">
    <h2 class="heading-title">
        {{ $advertising->title }}
    </h2>
</div>
<!--section 1-->
<section id="section-1" class="blog-page">
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