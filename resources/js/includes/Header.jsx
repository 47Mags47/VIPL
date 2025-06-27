import { Dropdown } from 'antd';
import ItemMenu from '@/components/menu/ItemMenu';
import { usePage } from '@inertiajs/react';


export default function Header() {
    const logo = 'VIPL';
    const user = usePage().props.user.data;

    const meny = {
        'system_admin': [
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
            { key: 'user', label: <ItemMenu itemKey="users" routeName="main.users.index"  text="Пользователи" /> }
        ],

        'division_admin': [
            { key: 'user', label: <ItemMenu itemKey="users" routeName="main.division.users.index" routeData={{ division: user.division.id }} text="Пользователи" /> }
        ],

        'user': []
    }

    const defaultMenyItems = [
        { key: 'events', label: <ItemMenu itemKey="events" routeName="payments.events.index" text="Календарь" /> },
        { key: 'logout', label: <ItemMenu itemKey="logout" routeName="logout" text="Выход" method='post' /> },
    ]

    let menuItems = []
    for (let role in user.roles){
        if(user.roles[role].code in meny)
            menuItems = menuItems.concat(meny[user.roles[role].code])
    }

    menuItems = menuItems.concat(defaultMenyItems)

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
        </header >
    );
}
