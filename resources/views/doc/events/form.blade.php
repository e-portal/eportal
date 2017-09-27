<div class="event-signup">
	<div class="signup-form"></div>
	<div class="event-form">
		<a class="signup-close" href="#"></a>
		<h4>Запись на мероприятие</h4>
		{!! Form::open(['url'=>route('event_sign_up'), 'method'=>'post']) !!}
		{!! Form::text('email', old('email') ? : '' , ['placeholder'=>'ваша почта', 'id'=>'email', 'class'=>'section-input']) !!}
		{!! Form::text('name', old('name') ? : '' , ['placeholder'=>'имя', 'id'=>'name', 'class'=>'section-input']) !!}
		{!! Form::text('phone', old('phone') ? : '' , ['placeholder'=>'телефон', 'id'=>'phone', 'class'=>'section-input']) !!}
		{{ Form::hidden('source', false, ['class'=>'event_source']) }}
		{!! Form::button('ОСТАВИТЬ ЗАЯВКУ', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
		{!! Form::close() !!}
	</div>

</div>
<style>
	.signup-close {
		position: absolute;
		top: 0;
		right: 0;
		overflow: hidden;
		padding: 9px;
		width: 38px;
		z-index: 2;
		transition: .5s all;
	}

	.signup-close:before {
		content: ' ';
		background-image: url(../../estet/img/slide/close.png);
		width: 21px;
		display: block;
		height: 21px;
		background-repeat: no-repeat;
	}

	.signup-close:hover {
		transform: rotate(180deg);
		filter: brightness(0);
	}
</style>


