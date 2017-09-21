<h3>Имейлы для контактов</h3>
{!! Form::open(['url' => route('contactus_admin'), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="row">
    {{ Form::label('email', 'E-mail') }}
    <div class="row">
        {!! Form::text('email', old('email') ? : '' , ['placeholder'=>'E-mail...', 'id'=>'email', 'class'=>'form-control']) !!}
    </div>
    <hr>
    <div class="row">
        {!! Form::button(trans('admin.add_spec'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
<hr>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>E-mail</th>
    </tr>
    </thead>
    @if (!empty($contacts[0]))
        <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->email }}</td>
                <td>
                    {!! Form::open(['url' => route('contactus_del',['id'=> $contact->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                    {!! Form::button(trans('admin.delete'), ['class' => 'btn btn-danger','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    @endif
</table>