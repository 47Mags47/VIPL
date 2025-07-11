<div>
    <h1>Вас пригласили {{ config('app.name') }}</h1>
    <p>
        Данные для входа:<br>
        Логин: {{ $user->email }}<br>
        Пароль: {{ $user->email }}
    </p>
    <a href="{{ route('main.users.invition.accept', ['user' => $user]) }}">Тыкни сюда</a>
</div>
