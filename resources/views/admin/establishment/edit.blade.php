<h2>Редактирование учреждения</h2>
<div class="row">
    {!! Form::open(['url' => route('edit_establishment', $establishment->id), 'method' => 'post', 'class' => 'form-horizontal', 'files'=>true]) !!}
    <div class="row">
        {{ Form::label('title', 'Название') }}
        {!! Form::text('title', old('title') ? : $establishment->title, ['placeholder' => 'Название учреждения', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
    <div class="row">
        {{ Form::label('description', 'Краткое описание') }}
        {!! Form::text('description', old('description') ? : ($establishment->description ?? ''),
         ['placeholder' => 'Краткое описание', 'id'=>'description', 'class'=>'form-control']) !!}
    </div>
    {{--Alias Phones--}}
    <div class="row">
        <div class="col-lg-6">
            {{ Form::label('alias', 'Псевдоним') }}
            {!! Form::text('alias', old('alias') ? : $establishment->alias, ['placeholder' => 'nazvanie-uchrezhdeniya', 'id'=>'alias', 'class'=>'form-control']) !!}
        </div>
        <div class="col-lg-6">
            {{ Form::label('phones', 'Телефоны') }}
            {!! Form::text('phones', old('phones') ? : $establishment->phones, ['placeholder' => '+38 050 555 55 55', 'id'=>'phones', 'class'=>'form-control']) !!}
        </div>
    </div>
    {{--Logo--}}
    <div class="row">
        {{ Form::label('img', 'Параметры логотипа') }}
        <div class="row">
            <div class="col-lg-6"><span>Alt</span>
                {!! Form::text('alt', old('alt') ? : ($establishment->alt ?? '') , ['placeholder'=>'Alt', 'id'=>'alt', 'class'=>'form-control']) !!}
            </div>
            <div class="col-lg-6"><span>Title</span>
                {!! Form::text('imgtitle', old('imgtitle') ? : ($establishment->imgtitle ?? '') , ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div>
            {{ Html::image(asset('/images/establishment/main').'/'. $establishment->logo, 'a picture', array('class' => 'thumb')) }}
        </div>
        {{ Form::label('logo', 'Логотип') }}
        <div class="row">
            {!! Form::file('logo', ['accept'=>'image/*', 'id'=>'logo', 'class'=>'form-control']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            {{ Form::label('category', 'Категория') }}
            {!! Form::select('category', ['Клиника', 'Дистрибьютор', 'Бренд'],
                old('category') ? : $establishment->category , [ 'class'=>'form-control', 'placeholder'=>'Категория'])
            !!}
        </div>
        <div class="col-lg-6">
            {{ Form::label('parent', 'Родитель') }}
            {!! Form::select('parent', $parents,
                old('parent') ? : $establishment->parent , [ 'class'=>'form-control', 'placeholder'=>'Родитель'])
            !!}
        </div>
    </div>
    <div class="row">
        {{ Form::label('address', 'Адрес') }}
        {!! Form::text('address', old('address') ? : $establishment->address, ['placeholder' => 'Город, улица...', 'id'=>'address', 'class'=>'form-control']) !!}
    </div>
    <div class="row">
        <div class="col-lg-6">
            {{ Form::label('site', 'Сайт') }}
            {!! Form::text('site', old('site') ? : $establishment->site, ['placeholder' => 'http://site.com...', 'id'=>'site', 'class'=>'form-control']) !!}
        </div>
        <div class="col-lg-6">
            {{ Form::label('spec', 'Специализация/Описание продукта(для бренда)') }}
            {!! Form::text('spec', old('spec') ? : ($establishment->spec ?? ''), ['placeholder' => 'специализация...', 'id'=>'spec', 'class'=>'form-control']) !!}
        </div>
    </div>
    <!-- SEO -->
    <div class="panel-heading">
        <h2>
            <a data-toggle="collapse" href="#service" class="btn btn-info btn-block">SEO</a>
        </h2>
    </div>
    <div id="service" class="panel-collapse collapse row">
        <div class="row">
            <div class="col-lg-6">
                {{ Form::label('seo_title', 'SEO_TITLE') }}
                <div>
                    {!! Form::text('seo_title', old('seo_title') ? : ($establishment->seo->seo_title ?? '') , ['placeholder'=>'seo_title', 'id'=>'seo_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('seo_keywords', 'SEO_KEYWORDS') }}
                <div>
                    {!! Form::text('seo_keywords', old('seo_keywords') ? : ($establishment->seo->seo_keywords ?? '') , ['placeholder'=>'seo_keywords', 'id'=>'seo_keywords', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                {{ Form::label('seo_description', 'SEO_DESCRIPTION') }}
                <div>
                    {!! Form::text('seo_description', old('seo_description') ? : ($establishment->seo->seo_description ?? '') , ['placeholder'=>'seo_description', 'id'=>'seo_description', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('og_image', 'OG_IMAGE') }}
                <div>
                    {!! Form::text('og_image', old('og_image') ? : ($establishment->seo->og_image ?? '') , ['placeholder'=>'og_image', 'id'=>'og_image', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                {{ Form::label('og_title', 'OG_TITLE') }}
                <div>
                    {!! Form::text('og_title', old('og_title') ? : ($establishment->seo->og_title ?? '') , ['placeholder'=>'og_title', 'id'=>'og_title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-6">
                {{ Form::label('og_description', 'OG_DESCRIPTION') }}
                <div>
                    {!! Form::text('og_description', old('og_description') ? : ($establishment->seo->og_description ?? '') , ['placeholder'=>'og_description', 'id'=>'og_description', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            {{ Form::label('seo_text', 'SEO_TEXT') }}
            <div>
            <textarea name="seo_text" rows="20"
                      class="form-control">{!! old('seo_text') ? : ($establishment->seo->seo_text ?? '') !!}</textarea>
            </div>
        </div>
    </div>
    <!-- SEO -->
    <div class="row">
        <div class="col-lg-6">
        {{ Form::label('services', 'Услуги\Категории продукции') }}
        @if(!empty($establishment->services) && is_array($establishment->services))
            <div class="block-to-add">
            @foreach($establishment->services as $k=>$serv)
                <div>
                {!! Form::text('services[]', old('services[$k]') ? : ($serv ?? ''), ['placeholder' => 'список...', 'id'=>'services[]', 'class'=>'form-control']) !!}
                    <span class="remove-slider"><button type="button" class="btn btn-danger">-</button></span>
                </div>
            @endforeach
            </div>
        @else
            <div class="block-to-add">
                <div>
                    {!! Form::text('services[]', old('services[0]') ? : '', ['placeholder' => 'список...', 'id'=>'services[]', 'class'=>'form-control']) !!}
                    <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
                </div>
            </div>
            @endif
            <div class="add-new"><button type="button" class="btn btn-primary">+</button></div>
        </div>
        <div class="col-lg-6">
            <h5>Дополнительно</h5>
            <div class="col-lg-6">
                {!! Form::text('extra[0][0]', old('extra[0][0]') ? : ($establishment->extra[0][0] ?? ''), ['placeholder' => 'Ключ 1', 'class'=>'form-control']) !!}
                {!! Form::text('extra[0][1]', old('extra[0][1]') ? : ($establishment->extra[0][1] ?? ''), ['placeholder' => 'Значение 1', 'class'=>'form-control']) !!}
            </div>
            <div class="col-lg-6">
                {!! Form::text('extra[1][0]', old('extra[1][0]') ? : ($establishment->extra[1][0] ?? ''), ['placeholder' => 'Ключ 2', 'class'=>'form-control']) !!}
                {!! Form::text('extra[1][1]', old('extra[1][1]') ? : ($establishment->extra[1][1] ?? ''), ['placeholder' => 'Значение 2', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        {{ Form::label('content', 'Описание') }}
        <textarea name="content" class="form-control editor">{!! old('content') ? : ($establishment->content) !!}</textarea>
    </div>
    <hr>
    {!! Form::button('Сохранить', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
    {!! Form::close() !!}
</div>
<div class="shablon" style="display:none">
    <div>
        {!! Form::text('services[]', old('services[0]') ? : '', ['placeholder' => 'список...', 'id'=>'services[]', 'class'=>'form-control']) !!}
        <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
    </div>
</div>