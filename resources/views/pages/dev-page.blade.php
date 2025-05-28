<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dev page</title>

    @vite('resources/js/App.jsx')
    @vite('resources/sass/app.sass')
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
            <li>
                <details>
                    <summary>Банк</summary>
                    <ul>
                        <li><a href="{!! route('glossary.banks.index') !!}">glossary.banks.index</a></li>
                        <li><a href="{!! route('glossary.banks.create') !!}">glossary.banks.create</a></li>
                        <li><a href="{!! route('glossary.banks.modal') !!}">glossary.banks.modal</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details>
                    <summary>Организации</summary>
                    <ul>
                        <li><a href="{!! route('glossary.divisions.index') !!}">glossary.divisions.index</a></li>
                        <li><a href="{!! route('glossary.divisions.create') !!}">glossary.divisions.create</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details>
                    <summary>Выплаты</summary>
                    <ul>
                        <li><a href="{!! route('glossary.payments.index') !!}">glossary.payments.index</a></li>
                        <li><a href="{!! route('glossary.payments.create') !!}">glossary.payments.create</a></li>
                        <li><a href="{!! route('glossary.payments.modal') !!}">glossary.payments.modal</a></li>
                    </ul>
                </details>
            </li>
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
<<<<<<< HEAD
        <ul>
            <li>
                <details>
                    <summary>Общие страницы</summary>
                    <ul>
                        <h4>Календарь выплат</h4>
                        <li><a href="{!! route('payment.calendar.index') !!}">payment.calendar.index</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details>
                    <summary>Страницы пользователей</summary>
                    <ul>
                        <h4>Пакет</h4>
                        <li><a href="{!! route('payment.package.edit') !!}">payment.package.edit</a></li>
                    </ul>
                    <ul>
                        <h4>Файл</h4>
                        <li><a href="{!! route('ftp.files.modal') !!}">ftp.files.modal</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details>
                    <summary>Страницы администратора</summary>
                    <ul>
                        <h4>Пакет</h4>
                        <li><a href="{!! route('payment.package.index') !!}">payment.package.index</a></li>
                    </ul>
                </details>
            </li>
        </ul>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b9e9bcc (мелкие фиксы)
=======
>>>>>>> 4aeaf42 (добавил вывод документации)
    </details>

    <details>
        <summary>Аунтификация</summary>
        <ul>
            <li><a href="{!! route('dev.login-to-admin') !!}">Войти под администратором</a></li>
            <li><a href="{!! route('dev.login-to-user') !!}">Войти под пользователем</a></li>
            <li><a href="{!! route('dev.auth-delete') !!}">Сбросить сессию</a></li>
        </ul>
    </details>
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======


        <h1>Документация</h1>
=======
<<<<<<< HEAD
>>>>>>> 2015824 (изменил маршрутизацию для тестовых страниц)
=======
>>>>>>> 419cdb3 (изменил маршрутизацию для тестовых страниц)
>>>>>>> d88b78d (изменил маршрутизацию для тестовых страниц)
        <ul>
            <li>
                <details>
                    <summary>Общие страницы</summary>
                    <ul>
                        <h4>Календарь выплат</h4>
                        <li><a href="{!! route('payment.calendar.index') !!}">payment.calendar.index</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details>
                    <summary>Страницы пользователей</summary>
                    <ul>
                        <h4>Пакет</h4>
                        <li><a href="{!! route('payment.package.edit') !!}">payment.package.edit</a></li>
                    </ul>
                    <ul>
                        <h4>Файл</h4>
                        <li><a href="{!! route('ftp.files.modal') !!}">ftp.files.modal</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details>
                    <summary>Страницы администратора</summary>
                    <ul>
                        <h4>Пакет</h4>
                        <li><a href="{!! route('payment.package.index') !!}">payment.package.index</a></li>
                    </ul>
                </details>
            </li>
        </ul>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 19867d2 (добавил вывод документации)
=======


        <h1>Документация</h1>
        <ul>
            <li>
                <h2>Экспортер</h2>
                <ul>
                    <li><a href="{!! route('docs.exporter') !!}">docs.exporter</a></li>
                </ul>
            </li>
        </ul>
>>>>>>> c51a9a4 (добавил вывод документации)
    </ul>
>>>>>>> 4ebf85c (мелкие фиксы)
=======
<<<<<<< HEAD
    </details>
>>>>>>> 2015824 (изменил маршрутизацию для тестовых страниц)
=======
    </ul>
>>>>>>> 62e7dea (мелкие фиксы)
<<<<<<< HEAD
>>>>>>> b50303c (мелкие фиксы)
=======
=======
    </details>
>>>>>>> 419cdb3 (изменил маршрутизацию для тестовых страниц)
<<<<<<< HEAD
>>>>>>> d88b78d (изменил маршрутизацию для тестовых страниц)
=======
=======
>>>>>>> 9c63970 (добавил аунтификацию тестовые страницы)
<<<<<<< HEAD
>>>>>>> db9c4a8 (добавил аунтификацию тестовые страницы)
=======
=======
=======
=======


        <h1>Документация</h1>
        <ul>
            <li>
                <h2>Экспортер</h2>
                <ul>
                    <li><a href="{!! route('docs.exporter') !!}">docs.exporter</a></li>
                </ul>
            </li>
        </ul>
>>>>>>> 19867d2 (добавил вывод документации)
    </ul>
>>>>>>> 4ebf85c (мелкие фиксы)
>>>>>>> b9e9bcc (мелкие фиксы)
>>>>>>> 585a8af (мелкие фиксы)
</body>

</html>
