import { Dropdown } from 'antd';
import ItemMenu from '@/components/menu/ItemMenu';
import { usePage } from '@inertiajs/react';


export default function Header() {
    const logo = 'VIPL';
    const allowedRoles = ['admin', 'root'];
    const user = usePage().props.user.data;

    const adminMenuItems = [
        {
            key: 'glossary',
            label: 'Справочники',
            children: [
                { key: 'banks', label: <ItemMenu itemKey="banks" routeName="glossary.banks.index" text="Банки" /> },
                { key: 'divisions', label: <ItemMenu itemKey="divisions" routeName="glossary.divisions.index" text="Подразделения" /> },
                { key: 'laws', label: <ItemMenu itemKey="laws" routeName="glossary.laws.index" text="Законы" /> },
                { key: 'payments', label: <ItemMenu itemKey="payments" routeName="glossary.payments.index" text="Выплаты" /> },
            ],
        },
        { key: 'user', label: <ItemMenu itemKey="users" routeName="main.users.index" text="Пользователи" /> },
        { key: 'events', label: <ItemMenu itemKey="events" routeName="payments.events.index" text="Календарь" /> },
        { key: 'logout', label: <ItemMenu itemKey="logout" routeName="session.destroy" text="Выход" method='post' /> },
    ];

    const userMenuItems = [
        { key: 'logout', label: <ItemMenu itemKey="logout" routeName="session.destroy" text="Выход" method='post' /> },
    ];

    const menuItems = user?.roles?.some(role => allowedRoles.includes(role.code))
        ? adminMenuItems
        : userMenuItems;

    return (
        <header>
            <h3 className="logo">{logo}</h3>

            <span className="user">
                <i className="fa-solid fa-user ico user-ico"></i>
                {user.name}
            </span>
            <Dropdown menu={{ items: menuItems }} trigger={['click']}>
                <button type="button" className="menu-toggle">
                    <i className="fa-solid fa-bars ico ico-menu"></i>
                </button>
            </Dropdown>
        </header>
    );
}
