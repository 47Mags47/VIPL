import { Menu } from 'antd';
import ItemMenu from '@/components/menu/ItemMenu';


export default function Header() {
    const logo = 'VIPL';
    const menuItems = [
        {
            key: 'glossary',
            label: 'Словари',
            children: [
                { key: 'banks', label: <ItemMenu itemKey="banks" routeName="glossary.banks.index" text="Банки" /> },
                { key: 'divisions', label: <ItemMenu itemKey="divisions" routeName="glossary.divisions.index" text="Подразделения" /> },
                { key: 'laws', label: <ItemMenu itemKey="laws" routeName="glossary.laws.index" text="Законы" /> },
                { key: 'payments', label: <ItemMenu itemKey="payments" routeName="glossary.payments.index" text="Выплаты" /> },
            ],
        },
        { key: 'events', label: <ItemMenu itemKey="events" routeName="payments.events.index" text="Календарь" /> },
        { key: 'logout', label: <ItemMenu itemKey="logout" routeName="logout" text="Выход" /> },
    ];
    return (
        <header>
            <h3 className="logo">{logo}</h3>
            <Menu
                mode="horizontal"
                items={menuItems}
                selectedKeys={[]}
            />
            <span className="user">Тут будет юзер</span>
        </header>
    );
}