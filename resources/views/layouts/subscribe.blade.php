<div class="form-wrap form-wrap-aside-block">
    {!! Form::open(['url'=>route('subscribe')]) !!}
    <h4 class="form-title">Будь в курсе последних новостей</h4>
    <strong>подпишись на рассылку</strong>
    <label>{!! Form::text('email', old('email') ? : '' , ['placeholder'=>'ваша почта', 'id'=>'email', 'class'=>'form-control' , 'required']) !!}</label>
    <label>
        {!! Form::select ('status ' , [0=>'я пациент', 1=>'я врач'],
            old('status') ? : '' , [ 'placeholder'=>'я пациент / я врач', 'onchange'=>"if(jQuery(this).val()==1){jQuery('#doctor-form').fadeIn();}else{jQuery('#doctor-form').hide();}"])
        !!}
    </label>
    <div id="doctor-form">
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
    </div>
    <button class="pod-subs
        @if(session()->has('doc'))
            pod-purpur
        @endif
            " type="submit">Подписаться
    </button>
    {!! Form::close() !!}
</div>


