<div class="title-main more">
    <h2 class="heading-title">
        {{ $contacts->title }}
    </h2>
</div>
<!--section 1-->
<section id="section-1" class="blog-page">
    <div class="left-title left-title-planshet">
        <div class="line-container text-vertical">
            <div class="vertical-line"></div>
            <h2>Контакты</h2>
        </div>
    </div>

    <div class="content content-vnutrennaya">
        <div class="main-content">
            <div class="content-centr">
                <div class="main-img-info">
                    <div class="images">
                        {!! $contacts->text !!}
                    </div>
                </div>
            </div>
            {{--form--}}
            <div class="comment-post">
                <div class="section-form">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <p class="error">
                                @foreach ($errors->toArray() as $key=>$error)
                                {!! str_replace($key, '<strong>' . trans('admin.' . $key) . '</strong>', $error[0]) !!}</br>
                                @endforeach
                            </p>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="add-comm">Добавить коментарий:</p>
                    {!! Form::open(['url' => route('contactus'),'class'=>'section-form-up','method'=>'post']) !!}
                    {!! Form::text('name', old('name') ? : '' , ['placeholder'=>'Имя', 'id'=>'name', 'class'=>'section-input']) !!}
                    {!! Form::text('email', old('email') ? : '' , ['placeholder'=>'Ваша почта', 'id'=>'email', 'class'=>'section-input']) !!}
                    {!! Form::text('subject', old('subject') ? : '' , ['placeholder'=>'Тема', 'id'=>'subject', 'class'=>'section-input']) !!}
                    {!! Form::textarea('text', old('text') ? : '' ,
                     ['placeholder'=>'Сообщение', 'id'=>'text', 'class'=>'form-control', 'rows'=>3, 'cols'=>40]) !!}
                    <div class="block-forms">
                        <div class="block-left">
                            <div class="reload">
                                <img src="{{ route('captcha') }}" class="captcha" id="captcha">
                                <p><img src="{{ asset('estet') }}/img/content/refresh.png" class="reload"
                                        alt="Обновить">Обновить</p>
                            </div>
                            <div class="block-right">
                                {!! Form::text('capt', old('capt') ? : '' , ['id'=>'capt', 'class'=>'section-input section-input-reload']) !!}
                            </div>
                        </div>
                        <div class="section-form-down">
                            <input class="but-section-form @if(session()->has('doc')) but-section-purpur @endif"
                                   type="submit">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            {{--form--}}
        </div>
        {!! $sidebar !!}
    </div>
</section>