<div class="event-signup">
    {!! Form::open(['url'=>route('event_sign_up'), 'method'=>'post']) !!}
    {!! Form::text('email', old('email') ? : '' , ['placeholder'=>'Ваша почта', 'id'=>'email', 'class'=>'section-input']) !!}
    {!! Form::text('name', old('name') ? : '' , ['placeholder'=>'Имя', 'id'=>'name', 'class'=>'section-input']) !!}
    {!! Form::text('phone', old('phone') ? : '' , ['placeholder'=>'Телефон', 'id'=>'phone', 'class'=>'section-input']) !!}
    {{ Form::hidden('source', false, ['class'=>'event_source']) }}
    {!! Form::button('Отправить', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
    {!! Form::close() !!}
</div>