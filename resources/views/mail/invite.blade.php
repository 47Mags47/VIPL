<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Приглашение в VIPL</title>
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f8fafd;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            font-family: sans-serif;
            color: #333333;
            line-height: 1.6;
        }

        .logo {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: rgb(34, 34, 34);
            margin-bottom: 20px;
        }

        .text {
            text-align: start;
            font-size: 18px;
            color: rgb(34, 34, 34);
            margin-bottom: 10px;
        }

        .role {
            font-weight: bold;
            color: #0e2938;
        }

        .data {
            background-color: #c2dcff;
            padding: 40px;
            border-radius: 10px;
            font-size: 16px;
            color: #2a2a2a;
            border-left: 4px solid #3D9AD1;
        }

        .accept-button-wrapper {
            text-align: center;
            margin: 10px 0;
            padding: 10px 0px 20px
        }

        .accept-button {
            background-color: #3D9AD1;
            width: 300px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 6px;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .footer {
            margin-top: 10px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo">
            {{ config('app.name') }}
        </div>
        <div class="text">
            Вы приглашены в {{ config('app.name') }} на роль:
            <span class="role">
                {!! implode(', ', $user->roles->map(fn($role) => $role->name)->toArray()) !!}
            </span><br>
        </div>
        <div class="data">
            Данные для входа:<br>
            Логин: {{ $user->email }}<br>
            Пароль: {{ $user->email }}<br>
        </div>
        <div class="accept-button-wrapper">
            <a href="{{ route('main.users.invition.accept', compact('user')) }}" class="accept-button"
                style="color: white;">
                Подтвердить
            </a>
        </div>
        <div class="footer">
            &copy; Copyright {{ date('Y') }} {{ config('app.name') }}. Все права защищены.
        </div>
    </div>
</body>

</html>
