@if(!empty($content))
    <h2>{{ $content['title'] }}</h2>
    Имя: {{ $content['name'] }}
    Телефон: {{ $content['phone'] }}
    Имейл: {{ $content['email'] }}
@endif
