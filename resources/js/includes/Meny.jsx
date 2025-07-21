import { usePage } from '@inertiajs/react';
import { Dropdown } from 'antd';
import { Link } from '@inertiajs/react';

import { BarsIco } from '@/components/icons';
import { RedButton } from '@/components/buttons';
import { router } from '@inertiajs/react';


export default function Meny() {
    const user = usePage().props.current_user.data

    const items = [
        {
            key: 'glossary',
            label: 'Справочники',
            permission: ['edit_glossary'],
            children: [
                { key: 'banks', label: 'Банки', route: 'glossary.banks.index' },
                { key: 'divisions', label: 'Подразделения', route: 'glossary.divisions.index' },
                { key: 'laws', label: 'Законы', route: 'glossary.laws.index' },
                { key: 'payments', label: 'Выплаты', route: 'glossary.payments.index' },
                { key: 'validator', label: 'Валидация', route: 'glossary.validator.index' },
                { key: 'sources', label: 'Финансирование', route: 'glossary.sources.index' },
                { key: 'glossary_events', label: 'График выплат', route: 'glossary.events.index' },
            ]
        },
        {
            key: 'users',
            label: 'Пользователи',
            route: 'main.users.index',
            permission: ['create_users'],
        },
        {
            key: 'config',
            label: 'Конфигурация',
            route: 'config.index',
            permission: ['system_configuration'],
        },
        {
            key: 'events',
            label: 'Календарь',
            route: 'payments.events.index',
        },
        {
            key: 'edit-password',
            label: 'Сменить пароль',
            route: 'password.edit',
        },
        {
            key: 'logout',
            label: 'Выход',
            route: 'logout',
            render: () => (<RedButton onClick={() => router.post(route('logout'))} confirm="Вы уверены, что хотите выйти?">Выход</RedButton>)
        },
    ]

    function generateDropDownItem(item) {
        if (item.permission !== undefined) {
            let hasPermission = item.permission.map((needlePermission) => user.permissions.includes('create_users')).includes(true)
            if (!hasPermission)
                return
        }

        return {
            key: item.key,
            label: item.children !== undefined
                ? item.label
                : (
                    item.render !== undefined
                        ? item.render()
                        : <Link href={route(item.route)} method={item.method ?? 'get'}>{item.label}</Link>
                ),
            children: item.children !== undefined
                ? item.children.map((child, i) => generateDropDownItem({ ...child, key: item.key + '_' + i }))
                : undefined
        }
    }

    return (
        <>
            <Dropdown
                menu={{ items: items.map(generateDropDownItem).filter((item) => item !== undefined) }}
                trigger={['click']}
            >
                <button type="button" className="menu-toggle">
                    <BarsIco />
                </button>
            </Dropdown>
        </>
    );
}
