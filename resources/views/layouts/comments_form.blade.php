<div class="comment-post">
    <div class="social-networks">
        <p>Добавьте в закладки чтобы не потерять / поделитесь с друзьями:</p>
        <div class="social-post">
            <a><img src="{{ asset('estet') }}/img/social/1.png" alt=""></a>
            <a><img src="{{ asset('estet') }}/img/social/2.png" alt=""></a>
            <a><img src="{{ asset('estet') }}/img/social/3.png" alt=""></a>
            <a><img src="{{ asset('estet') }}/img/social/3.png" alt=""></a>
            <a><img src="{{ asset('estet') }}/img/social/3.png" alt=""></a>
            <a><img src="{{ asset('estet') }}/img/social/6.png" alt=""></a>
        </div>
    </div>
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
        {!! Form::open(['url' => route('comments'),'class'=>'section-form-up','method'=>'post']) !!}
        {!! Form::text('email', old('email') ? : '' , ['placeholder'=>'Ваша почта', 'id'=>'email', 'class'=>'section-input']) !!}
        {!! Form::text('name', old('name') ? : '' , ['placeholder'=>'Имя', 'id'=>'name', 'class'=>'section-input']) !!}
        {!! Form::textarea('text', old('text') ? : '' ,
         ['placeholder'=>'Коментарий', 'id'=>'text', 'class'=>'form-control', 'rows'=>3, 'cols'=>40]) !!}
        <div class="block-forms">
            <div class="block-left">
                <div class="reload">
                    <img src="{{ route('captcha') }}" class="captcha" id="captcha">
                    <p><img src="{{ asset('estet') }}/img/content/refresh.png" class="reload" alt="Обновить">Обновить
                    </p>
                </div>
                <div class="block-right">
                    {!! Form::text('capt', old('capt') ? : '' , ['id'=>'capt', 'class'=>'section-input section-input-reload']) !!}
                </div>
            </div>
            <div class="section-form-down">
                <input class="but-section-form @if(session()->has('doc')) but-section-purpur @endif" type="submit">
            </div>
        </div>
        {{ Form::hidden('comment_post_ID', $id) }}
        {{ Form::hidden('comment_parent', 0) }}
        {{ Form::hidden('comment_source', $source) }}
        {!! Form::close() !!}
    </div>
</div>