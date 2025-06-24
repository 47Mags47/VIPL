import { usePage } from "@inertiajs/react";


export default function RouteList() {
    const data = usePage().props

    return (
        <>
            <details>
                <summary>Справочники</summary>
                <ul>
                    <li><a href={route('glossary.banks.index')}>Банки</a></li>
                    <li><a href={route('glossary.divisions.index')}>Подразделения</a></li>
                    <li><a href={route('glossary.laws.index')}>Законы</a></li>
                    <li><a href={route('glossary.payments.index')}>Выплаты</a></li>
                </ul>
            </details>

            <details>
                <summary>Правила проверки</summary>
                <ul>
                    <li><a href={route('glossary.importer.validator.columns.index')}>Счет получателя</a></li>
                </ul>
            </details>

            <details>
                <summary>Выплаты</summary>
                <ul>
                    <li><a href={route('payments.events.index')}>Календарь выплат</a></li>
                    <li><a href={route('payments.event.packages.index', { event: 1 })}>Пакеты</a></li>
                    <li><a href={route('payments.package.files.index', { package: data.package })}>Файлы</a></li>
                    <li><a href={route('payments.file.recipients.index', { file: 1 })}>Получатели</a></li>
                </ul>
            </details >

            <details>
                <summary>Аунтификация</summary>
                <ul>
                    <li><a href={route('dev.login-to-admin')}>Войти под администратором</a></li>
                    <li><a href={route('dev.login-to-user')}>Войти под пользователем</a></li>
                    <li><a href={route('dev.auth-delete')}>Сбросить сессию</a></li>
                </ul>
            </details>

            <details>
                <summary>Сообщения</summary>
                <ul>
                    <li><a href={route('dev.test-flash')}>тестовые flash сообщения</a></li>
                </ul>
            </details>
        </>
    )
}
