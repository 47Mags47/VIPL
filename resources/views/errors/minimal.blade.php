<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f8fafd;
            font-family: sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333333;
        }

        .error-container {
            text-align: center;
        }

        .error-code {
            font-size: 132px;
            font-weight: bold;
            color: #3D9AD1;
            margin-bottom: 10px;
        }

        .error-message {
            font-size: 24px;
            color: #2a2a2a;
            margin-bottom: 20px;
        }

        .back-button {
            display: inline-block;
            background-color: #3D9AD1;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #00a2ff;
        }
    </style>
</head>
<body>

<div class="error-container">
    <div class="error-code">
        @yield('code')
    </div>
    <div class="error-message">
        @yield('message')
    </div>
        <a href="{{ route('payments.events.index') }}" class="back-button">
            Вернуться на главную
        </a>
        <a class="back-button" onclick="location.reload()">
            Обновить
        </a>
    </div>
</div>

</body>
</html>
