import { usePage, router, Link } from '@inertiajs/react'
import { useEffect, useState } from 'react'

import { Badge, Calendar } from 'antd'
import locale from 'antd/locale/ru_RU'
import dayjs from 'dayjs'
import 'dayjs/locale/ru'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import BlueButton from '@/components/buttons/BlueButton'


export default function Index() {
    const events = usePage().props.events

    const [value, setValue] = useState(dayjs())

    const getListData = value => {
        let listData = []
        let eventList = events[value.format('YYYY-MM-DD')] ?? []

        eventList.forEach(item => {
            listData.push({
                type: 'success',
                content: (
                    <Link
                        className="show-link"
                        href={route('payments.events.show', { event: item.data.id })}
                    >
                        {item.data.name}
                    </Link>
                ),
                id: item.data.id
            })
        })

        return listData
    }

    const dateCellRender = value => {
        const listData = getListData(value)
        return (
            <ul className="events">
                {listData.map(item => (
                    <li key={item.id}>
                        <Badge status={item.type} text={item.content} />
                    </li>
                ))}
            </ul>
        )
    }

    const handlePanelChange = (date, mode) => {
        if (mode === 'month') {
            setValue(date);
            router.get(route('payments.events.index', {
                month: date.month() + 1,
                year: date.year()
            }), {}, {
                preserveState: true,
                replace: true
            })
        }
    }

    const goToCurrentMonth = () => {
        setValue(dayjs())
        router.get(route('payments.events.index', {
            month: dayjs().month() + 1,
            year: dayjs().year()
        }), {}, {
            preserveState: true,
            replace: true
        })
    }

    dayjs.locale('ru')

    const cellRender = (current, info) => {
        if (info.type === 'date') return dateCellRender(current);
        return info.originNode;
    }

    return (
        <AuthenticatedLayout>
            <div className='calendar-action'>
                <BlueButton onClick={goToCurrentMonth}>
                    Текущий месяц
                </BlueButton>
            </div>
            <Calendar
                value={value}
                onPanelChange={handlePanelChange}
                cellRender={cellRender}
                locale={locale.Calendar}
            />
        </AuthenticatedLayout>
    )
}
