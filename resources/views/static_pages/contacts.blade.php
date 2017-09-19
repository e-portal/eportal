<div class="title-main ">
    <p class="heading-title">
        {{ $contacts->title }}
    </p>
</div>
<!--section 1-->
<section id="section-1" class="horoscope">
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
            <div class="comment-post">
                <div class="section-form">
                    <p class="add-comm">Добавить коментарий:</p>
                    {!! Form::open(['url' => route('contactus'),'class'=>'section-form-up','method'=>'post']) !!}
                    {!! Form::text('name', old('name') ? : '' , ['placeholder'=>'Имя', 'id'=>'name', 'class'=>'section-input']) !!}
                    {!! Form::text('email', old('email') ? : '' , ['placeholder'=>'Ваша почта', 'id'=>'email', 'class'=>'section-input']) !!}
                    {!! Form::text('subject', old('subject') ? : '' , ['placeholder'=>'Тема', 'id'=>'subject', 'class'=>'section-input']) !!}
                    {!! Form::textarea('text', old('text') ? : '' ,
                     ['placeholder'=>'Сообщение', 'id'=>'text', 'class'=>'form-control', 'rows'=>3, 'cols'=>40]) !!}
                    <div class="section-form-down">
                        <input class="but-section-form @if(session()->has('doc')) but-section-purpur @endif"
                               type="submit"></input>
                    </div>
                    <div class="reload">
                        <img src="{{ route('captcha') }}" class="captcha" id="captcha">
                    </div>
                    {!! Form::text('capt', old('capt') ? : '' , ['placeholder'=>'Введите символы с картинки', 'id'=>'capt', 'class'=>'section-input']) !!}
                    <p><img src="{{ asset('estet') }}/img/content/refresh.png" class="reload" alt="Обновить">Обновить
                    </p>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        {!! $sidebar !!}
    </div>
</section>