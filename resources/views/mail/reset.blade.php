<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Восстановление пароля — {{ config('app.name') }}</title>
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
            text-align: center;
            font-size: 18px;
            color: rgb(255, 97, 97);
            margin-bottom: 20px;
        }

        .data {
            background-color: #c2dcff;
            padding: 30px;
            border-radius: 10px;
            font-size: 16px;
            color: #2a2a2a;
            margin-bottom: 20px;
            border-left: 4px solid #3D9AD1;
        }

        .accept-button-wrapper {
            text-align: center;
            margin: 10px 0;
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
            margin-top: 30px;
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
        <div class="data">
            Мы получили запрос на восстановление пароля для вашей учётной записи.
            Нажмите на кнопку ниже, чтобы сбросить пароль:
            <div class="accept-button-wrapper">
            <a href="{{ route('password.reset', compact('token')) }}" class="accept-button" style="color: white;">
                Сбросить пароль
            </a>
        </div>
        </div>

        <div class="text">
            Если вы не запрашивали сброс пароля, проигнорируйте это письмо.
        </div>

        <div class="footer">
            &copy; Copyright {{ date('Y') }} {{ config('app.name') }}. Все права защищены.
        </div>
    </div>
</body>
</html>
