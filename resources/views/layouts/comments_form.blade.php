@include('layouts.comments', ['comments' => $comments])
<hr>
<div class="comment-post">
    <div class="social-networks">
        <p>Добавьте в закладки чтобы не потерять / поделитесь с друзьями:</p>
        <div class="social-post">
            <a href="https://www.facebook.com/EstetPortalProf/" target="_blank" rel="nofollow"><img
                        src="{{ asset('estet') }}/img/social/facebook_b.svg" alt=""></a>
            <a href="https://www.youtube.com/user/stesthetic/" target="_blank" rel="nofollow"><img
                        src="{{ asset('estet') }}/img/social/youtube_b.svg" alt=""></a>
            <a href="https://twitter.com/Pro_Estet" target="_blank" rel="nofollow"><img
                        src="{{ asset('estet') }}/img/social/twitter_b.svg" alt=""></a>
            <a href="http://vk.com/estetportal" target="_blank" rel="nofollow"><img
                        src="{{ asset('estet') }}/img/social/vk_b.svg" alt=""></a>
            <a href="http://ok.ru/estetportal" target="_blank" rel="nofollow"><img
                        src="{{ asset('estet') }}/img/social/odnoklasniki_b.svg" alt=""></a>
            <a href="https://plus.google.com/+Эстетическаямедицина" target="_blank" rel="nofollow"><img
                        src="{{ asset('estet') }}/img/social/google_b.svg" alt=""></a>
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
                    {!! Form::text('capt', old('capt') ? : '' , ['id'=>'capt', 'class'=>'section-input section-input-reload', 'maxlength'=>'5']) !!}
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