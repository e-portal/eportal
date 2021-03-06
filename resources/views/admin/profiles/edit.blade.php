<h1>Edit profile</h1>
{!! Form::open(['url' => route('edit_profiles', $profile->user_id), 'class'=>'form-horizontal', 'method'=>'POST', 'files'=>true]) !!}
{{ csrf_field() }}
<ul class="list-group">
    <li class="list-group-item">
        {{ Form::label('name', '* Имя') }}
        <div>
            {!! Form::text('name', old('name') ? : ($profile->name ?? '' ), ['placeholder'=>'Или имя отчество', 'id'=>'name',
                        'required' => '', 'class'=>'form-control']) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('lastname', '* Фамилия') }}
        <div>
            {!! Form::text('lastname', old('lastname') ? : ($profile->lastname ?? '' ), ['placeholder'=>'Фамилия', 'id'=>'lastname',
                        'required' => '', 'class'=>'form-control']) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('phone', '* Телефон') }}
        <div>
            {!! Form::text('phone', old('phone') ? : ($profile->phone ?? '' ), ['placeholder'=>'+380 ...', 'id'=>'phone',
                        'required' => '', 'class'=>'form-control']) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('specialty', '* Специальность') }}
        <div>
            <h3>{{ $profile->specialty ?? '' }}</h3>
        </div>
        <div>
            <table class="table">
            @foreach($specialties as $id=>$specialty)
                @if($person != null && $person->hasSpecialty($specialty))
                        <td>
                            <input checked name="specialty[]"  type="checkbox" value="{{ $id }}"> {{ $specialty }}
                        </td>
                    @else
                        <td>
                            <input name="specialty[]"  type="checkbox" value="{{ $id }}"> {{ $specialty }}
                        </td>
                    @endif
                @endforeach
            </table>
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('category', 'Категория') }}
        <div>
            {!! Form::text('category', old('category') ? : ($profile->category ?? '' ), ['placeholder'=>'Врач высшей кат...', 'id'=>'category', 'class'=>'form-control']) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('job', 'Место основной работы') }}
        <div>
            {!! Form::text('job', old('job') ? : ($profile->job ?? '' ), ['placeholder'=>'Институт, клиника...', 'id'=>'job', 'class'=>'form-control']) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('address', 'Адрес основной работы') }}
        <div>
            {!! Form::text('address', old('address') ? : ($profile->address ?? '' ), ['placeholder'=>'Страна, город...', 'id'=>'address','class'=>'form-control']) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('expirience', 'Опыт') }}
            <div>
            {!! Form::select('month',
                [
                    1=>'Январь',
                    2=>'Февраль',
                    3=>'Март',
                    4=>'Апрель',
                    5=>'Май',
                    6=>'Июнь',
                    7=>'Июль',
                    8=>'Август',
                    9=>'Сентябрь',
                    10=>'Октябрь',
                    11=>'Ноябрь',
                    12=>'Декабрь',
                ], old('month') ? : ($profile->month ?? '' ), [ 'class'=>'form-control', 'placeholder'=>'Месяц'])
            !!}
            {!! Form::selectRange('year', 1970, 2020, old('year') ? : ($profile->year ?? '' ), ['placeholder' => 'Год', 'class'=>'form-control']) !!}
            </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('shedule', 'Часы приема') }}
        <div>
            {!! Form::text('shedule', old('shedule') ? : ($profile->shedule ?? '' ), ['placeholder'=>'Пн-Ср 10:00-17:00', 'id'=>'shedule', 'class'=>'form-control']) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('services', 'Услуги') }}
        @if(!empty($profile->services) && is_array($profile->services))
                <div class="row">
                    <div class="block-to-add">
                    @foreach($profile->services as $key=>$service)
                            <div>
                                {!! Form::text('services[]', old('services[$key]') ? : ($service ?? '' ), ['placeholder'=>'Пересадка бровей, ресниц, бороды...', 'class'=>'form-control']) !!}
                                <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
                            </div>
                    @endforeach
                    </div>
                    <div class="add-new"><button type="button" class="btn btn-primary">+</button></div>
                </div>
        @else
            <div class="row">
                <div class="block-to-add">
                    <div>
                        {!! Form::text('services[]', old('services[]') ? : '', ['placeholder'=>'Пересадка бровей, ресниц, бороды...', 'class'=>'form-control']) !!}
                        <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
                    </div>
                </div>
                <div class="add-new"><button type="button" class="btn btn-primary">+</button></div>
            </div>
        @endif
    </li>
    <li class="list-group-item">
        {{ Form::label('alias', 'Псевдоним профиля') }}
        <div>
            {!! Form::text('alias', old('alias') ? : ($profile->alias ?? '' ), ['placeholder'=>'Уникальный идентификатор профиля', 'id'=>'alias', 'class'=>'form-control']) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('site', 'Сайт') }}
        <div>
            {!! Form::text('site', old('site') ? : ($profile->site ?? '' ), ['placeholder'=>'Оставьте поле пустым, чтобы использовался профиль данного сайта', 'id'=>'site', 'class'=>'form-control']) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('content', 'О себе') }}
        <div>
            {!! Form::textarea('content', old('content') ? : ($profile->content ?? '' ), ['id'=>'content', 'class'=>"form-control editor", 'rows'=>8, 'cols'=>100]) !!}
        </div>
    </li>
    <li class="list-group-item">
        {{ Form::label('img', 'Фото') }}
        @if(!empty(session('photo')))
            <img class="img-thumbnail"
                 src="{{ asset(config('settings.theme'))  . '/img/tmp_profile/main/' . ($profile->photo ?? '../no_photo.jpg') }}">
            <div>
            <label><input type="checkbox" {{ (old('photo_status') || empty(session('photo'))) ? 'checked' : '' }} value="aply" name="photo_status"> Подтвердить фото</label>
        </div>
        @else
            <img class="img-thumbnail"
                 src="{{ asset(config('settings.theme'))  . '/img/profile/main/' . ($profile->photo ?? '../no_photo.jpg') }}">
        @endif
    </li>
    <li class="list-group-item">
        <label><input type="checkbox" {{ (old('confirmed') || !empty($profile->confirmed)) ? 'checked' : '' }} value="doc" name="confirmed"> Назначить автором</label>
    </li>
</ul>
{!! Form::button(trans('admin.save'), ['class' => 'btn btn-success','type'=>'submit']) !!}
{!! Form::close() !!}
<div class="shablon" style="display:none">
    <div>
        {!! Form::text('services[]', old('services[]') ? : '', ['placeholder'=>'Пересадка бровей, ресниц, бороды...', 'class'=>'form-control']) !!}
        <span class="remove-this"><button type="button" class="btn btn-danger">-</button></span>
    </div>
</div>