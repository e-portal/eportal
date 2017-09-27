<h2>Редактирование Рекламы</h2>
<hr>
{!! Form::open(['url'=>route('advertising_update', $advertising->id), 'method'=>'post', 'class'=>'form-horizontal']) !!}
<div class="row">
    <div class="row">
        {{ Form::label('text', 'Контент') }}
        <div>
            {!! Form::textarea('text', old('text') ? : ($advertising->text ?? '') , ['placeholder'=>'text', 'id'=>'text', 'class'=>'form-control']) !!}
        </div>
        {{ Form::label('text2', 'Контент 2') }}
        <div>
            {!! Form::textarea('text2', old('text2') ? : ($advertising->text2 ?? '') , ['placeholder'=>'text', 'id'=>'text2', 'class'=>'form-control']) !!}
        </div>
        {{ Form::label('text3', 'Контент 3') }}
        <div>
            {!! Form::textarea('text3', old('text3') ? : ($advertising->text3 ?? '') , ['placeholder'=>'text', 'id'=>'text3', 'class'=>'form-control']) !!}
        </div>
        {{ Form::label('text4', 'Контент 4') }}
        <div>
            {!! Form::textarea('text4', old('text4') ? : ($advertising->text4 ?? '') , ['placeholder'=>'text', 'id'=>'text4', 'class'=>'form-control']) !!}
        </div>
        {{ Form::label('text5', 'Контент 5') }}
        <div>
            {!! Form::textarea('text5', old('text5') ? : ($advertising->text5 ?? '') , ['placeholder'=>'text', 'id'=>'text5', 'class'=>'form-control']) !!}
        </div>
    </div>
</div>
<hr>
{!! Form::button('Сохранить', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
{!! Form::close() !!}