<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dev page</title>
</head>

<body>
    <style>
        body {
            overflow-y: auto;
        }

        ul {
            padding: 5px 10px;
        }

        li {
            padding: 5px 0;
            list-style: none;
        }

        summary {
            cursor: pointer;
        }

        a {
            transition: .3s
        }

        a:hover {
            color: darkblue
        }
    </style>

    <details>
        <summary>Справочники</summary>
        <ul>
            <li><a href="{!! route('glossary.banks.index') !!}">Банки</a></li>
            <li><a href="{!! route('glossary.divisions.index') !!}">Подразделения</a></li>
            <li><a href="{!! route('glossary.laws.index') !!}">Законы</a></li>
            <li><a href="{!! route('glossary.payments.index') !!}">Выплаты</a></li>
        </ul>
    </details>

    <details>
        <summary>Правила проверки</summary>
        <ul>
            <li>
                <details>
                    <summary>Счет получателя</summary>
                    <ul>
                        <li><a href="{!! route('validate.accounts.create') !!}">validate.accounts.create</a></li>
                    </ul>
                </details>
            </li>
        </ul>
    </details>

    <details>
        <summary>Выплаты</summary>
        <ul>
            <li><a href="{!! route('payments.events.index') !!}">Календарь выплат</a></li>
            <li><a href="{!! route('payments.packages.index') !!}">Пакеты</a></li>
        </ul>
    </details>

    <details>
        <summary>Аунтификация</summary>
        <ul>
            <li><a href="{!! route('dev.login-to-admin') !!}">Войти под администратором</a></li>
            <li><a href="{!! route('dev.login-to-user') !!}">Войти под пользователем</a></li>
            <li><a href="{!! route('dev.auth-delete') !!}">Сбросить сессию</a></li>
        </ul>
    </details>
</body>

</html>
