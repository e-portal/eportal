Отправка формы "Контакты"
@if(!empty($content))
    <p>{{ $content }}</p>
@endif
@if(!empty($name))
    <h3>Отправитель: {{ $name }}</h3>
@endif
