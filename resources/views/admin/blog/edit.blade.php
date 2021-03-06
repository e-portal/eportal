<h2>{{$title}}</h2>
{!! Form::open(['url'=>route('moderate_blog', $content->id), 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true]) !!}
{{ csrf_field() }}
<div class="row">
    {{ Form::label('title', 'Заголовок страницы') }}
    <div>
        {!! Form::text('title', old('title') ? : ($tmp->title ?? ($content->title ?? '')) , ['placeholder'=>'Title', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="row">
        {{ Form::label('img', 'Основное изображение') }}
    @if(!empty($img))
    <div>
        @if(!empty($tmp->image) && $tmp->image != $img->path)
        {{ Html::image(asset('/images/blog/tmp').'/'.$tmp->image, 'a picture', array('class' => 'thumb')) }}
        @else
        {{ Html::image(asset('/images/blog/main').'/'.$img->path, 'a picture', array('class' => 'thumb')) }}
        @endif
    </div>
    @endif
    {{ Form::label('img', 'Параметры картинки') }}
    <div class="row">
        <div class="col-lg-6">
            {!! Form::text('imgalt', old('imgalt') ? : ($img->alt ?? '') , ['placeholder'=>'Alt', 'id'=>'imgalt', 'class'=>'form-control']) !!}
        </div>
        <div class="col-lg-6">
            {!! Form::text('imgtitle', old('imgtitle') ? : ($img->title ?? '') , ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
        </div>
    </div>
    <div>
        {!! Form::file('img', ['accept'=>'image/*', 'id'=>'img', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="row">
    {{ Form::label('alias', 'Псевдоним страницы') }}
    <div>
        {!! Form::text('alias', old('alias') ? : ($content->alias ?? '') , ['placeholder'=>'psevdonim-stranici', 'id'=>'alias', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="row">
    {{ Form::label('cats', 'Категория') }}
    <div>
        {!! Form::select('cats', $cats ?? [],
            old('cats') ? : ($tmp->category ?? ($content->category_id ?? '')) , [ 'class'=>'form-control', 'placeholder'=>'Категория'])
        !!}
    </div>
</div>
<div class="row">
    {{ Form::label('tags', 'Тэги') }}
    @if(!empty($tags))
    <div>
        <table class="table">
            @foreach($tags as $id=>$tag)
                <td>
                    <input name="tags[]"  type="checkbox"
                    @if(!empty(old('tags')))
                        @foreach(old('tags') as $val)
                            @if($val == $id)
                                 checked
                            @endif
                        @endforeach
                    @elseif($content->hasTag($id))
                        checked
                    @endif
                    value="{{ $id }}"> {{ $tag }}
                </td>
            @endforeach
        </table>
    </div>
    @endif
</div>
<!-- SEO -->
<div class="panel-heading">
    <h2>
        <a data-toggle="collapse" href="#service" class="btn btn-info btn-block">SEO</a>
    </h2>
</div>
<div id="service" class="panel-collapse collapse row">
<div class="row">
    <h2>SEO</h2>
    <div class="row">
        <div class="col-lg-6">
            {{ Form::label('seo_title', 'SEO_TITLE') }}
            <div>
                {!! Form::text('seo_title', old('seo_title') ? : ($content->seo->seo_title ?? '') , ['placeholder'=>'seo_title', 'id'=>'seo_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('seo_keywords', 'SEO_KEYWORDS') }}
            <div>
                {!! Form::text('seo_keywords', old('seo_keywords') ? : ($content->seo->seo_keywords ?? '') , ['placeholder'=>'seo_keywords', 'id'=>'seo_keywords', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            {{ Form::label('seo_description', 'SEO_DESCRIPTION') }}
            <div>
                {!! Form::text('seo_description', old('seo_description') ? : ($content->seo->seo_description ?? '') , ['placeholder'=>'seo_description', 'id'=>'seo_description', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_image', 'OG_IMAGE') }}
            <div>
                {!! Form::text('og_image', old('og_image') ? : ($content->seo->og_image ?? '') , ['placeholder'=>'og_image', 'id'=>'og_image', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            {{ Form::label('og_title', 'OG_TITLE') }}
            <div>
                {!! Form::text('og_title', old('og_title') ? : ($content->seo->og_title ?? '') , ['placeholder'=>'og_title', 'id'=>'og_title', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('og_description', 'OG_DESCRIPTION') }}
            <div>
                {!! Form::text('og_description', old('og_description') ? : ($content->seo->og_description ?? '') , ['placeholder'=>'og_description', 'id'=>'og_description', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        {{ Form::label('seo_text', 'SEO_TEXT') }}
        <div>
            <textarea name="seo_text" class="form-control"
                      rows="20">{!! old('seo_text') ? : ($content->seo->seo_text ?? '') !!}</textarea>
        </div>
    </div>
</div>
</div>
<!-- SEO -->
<div class="row>">
    <h4>{!! Form::label('outputtime', trans('admin.add_outputtime')) !!}</h4>
    <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
        <input type="text" name="outputtime" id="outputtime" value="{{ old('outputtime') ? : (date('Y-m-d H:i', strtotime($content->created_at)) ?? date('Y-m-d H:i')) }}">
    </div>
</div>
<div class="row">
    <!-- Approved -->
    @if(Auth::user()->canDo('CONFIRMATION_DATA'))
        <label><input type="checkbox" {{ (old('confirmed') || !empty($content->approved)) ? 'checked' : '' }} value="1" name="confirmed"> В тираж</label>
    @endif

</div>
<div class="row">
    <textarea name="content" class="form-control editor">{!! old('content') ? : ($tmp->content ?? ($content->content ?? '')) !!}</textarea>
    {!! Form::button('Сохранить', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}
