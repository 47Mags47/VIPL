import { usePage } from '@inertiajs/react';
import { Dropdown } from 'antd';

import ItemMenu from '@/components/menu/ItemMenu';


export default function Meny() {
    const user = usePage().props.current_user.data;

    let meny = []
    if (user.permissions.includes('edit_glossary'))
        meny.push({
            key: 'glossary',
            label: 'Справочники',
            children: [
                { key: 'banks', label: <ItemMenu itemKey="banks" routeName="glossary.banks.index" text="Банки" /> },
                { key: 'divisions', label: <ItemMenu itemKey="divisions" routeName="glossary.divisions.index" text="Подразделения" /> },
                { key: 'laws', label: <ItemMenu itemKey="laws" routeName="glossary.laws.index" text="Законы" /> },
                { key: 'payments', label: <ItemMenu itemKey="payments" routeName="glossary.payments.index" text="Выплаты" /> },
                { key: 'validate', label: <ItemMenu itemKey="validate" routeName="glossary.validator.index" text="Валидация" /> },
                { key: 'sources', label: <ItemMenu itemKey="sources" routeName="glossary.sources.index" text="Финансирование" /> },
                { key: 'event-list', label: <ItemMenu itemKey="event-list" routeName="glossary.events.index" text="График выплат" /> },
            ],
        })

    if (user.permissions.includes('create_users'))
        meny.push({ key: 'users', label: <ItemMenu itemKey="users" routeName="main.users.index" text="Пользователи" /> })

    if (user.permissions.includes('system_configuration'))
        meny.push({ key: 'config', label: <ItemMenu itemKey="config" routeName="config.index" text="Конфигурация" /> })

    const defaultMenyItems = [
        { key: 'events', label: <ItemMenu itemKey="events" routeName="payments.events.index" text="Календарь" /> },
        { key: 'dashboard', label: <ItemMenu itemKey="dashboard" routeName="main.dashboard.index" text="Личный кабинет" /> },
        { key: 'edit-password', label: <ItemMenu itemKey="edit-password" routeName="password.edit" text="Сменить пароль" /> },
        { key: 'logout', label: <ItemMenu itemKey="logout" routeName="logout" text="Выход" method='post' /> },
    ]

    let menuItems = meny.concat(defaultMenyItems)

    return (
        <Dropdown menu={{ items: menuItems }} trigger={['click']}>
            <button type="button" className="menu-toggle">
                <i className="fa-solid fa-bars ico ico-menu"></i>
            </button>
        </Dropdown>
    );
}
