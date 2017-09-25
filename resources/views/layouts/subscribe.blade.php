<div class="form-wrap form-wrap-aside-block">
    {{--@if (count($errors) > 0)
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
    @endif--}}
    {!! Form::open(['url'=>route('subscribe')]) !!}
    <h4 class="form-title">Будь в курсе последних новостей</h4>
    <strong>подпишись на рассылку</strong>
    <label>{!! Form::text('email', old('email') ? : '' , ['placeholder'=>'почта', 'id'=>'email', 'class'=>'form-control']) !!}</label>
    <label>
        {!! Form::select('status', [0=>'Пациент', 1=>'Доктор'],
            old('status') ? : '' , [ 'placeholder'=>'доктор/пациент'])
        !!}
    </label>
    <label>
        {!! Form::select('status', [
            0=>'Косметолог',
            1=>'Дерматолог',
            2=>'Пластический хирург',
            3=>'Стоматолог',
            4=>'Гинеколог',
            5=>'Трихолог',
            6=>'Эндокринолог',
            7=>'Венеролог',
            8=>'Уролог',
            9=>'Врач другой специализации',
            ],
            old('status') ? : '' , [ 'placeholder'=>'cпециализация'])
        !!}
    </label>
    <button class="pod-subs
        @if(session()->has('doc'))
            pod-purpur
        @endif
            " type="submit">Подписаться
    </button>
    {!! Form::close() !!}
</div>