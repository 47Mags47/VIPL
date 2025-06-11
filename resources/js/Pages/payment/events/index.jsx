import { usePage, router } from '@inertiajs/react';
import { useEffect, useState } from 'react';

import locale from 'antd/locale/ru_RU';
import dayjs from 'dayjs'
import 'dayjs/locale/ru';

import { Badge, Calendar } from 'antd';
import Link from '@/components/Link';


export default function Index() {
    const events = usePage().props.events;
    const [value, setValue] = useState(() => {
        dayjs().year(events.year),
            dayjs().month(events.month + 1)
    });
    useEffect(() => {
        setValue(
            dayjs().year(events.year),
            dayjs().month(events.month + 1)
        );
    }, [events.month, events.year]);

    function show({ data }) {
        router.get(route('payments.events.show', { event: data }));
    }

    const getListData = value => {
        let listData = [];
        let dateString = value.format('YYYY-MM-DD')
        let eventList = events[dateString] ?? []

        eventList.forEach(element => {
            let data = element.data.id
            listData.push({
                type: 'success',
                content:
                    <Link
                        className="show-link"
                        onClick={() => show({ data })}
                    >
                        {element.data.payment.krv}
                    </Link>,
                id: element.data.id
            })
        });
        return listData || [];
    };

    const dateCellRender = value => {
        const listData = getListData(value);
        return (
            <ul className="events">
                {listData.map(item => (
                    <li key={item.id}>
                        <Badge
                            status={item.type}
                            text={item.content}
                        />
                    </li>
                ))}
            </ul>
        );
    };

    const handlePanelChange = (date, mode) => {
        if (mode === 'month') {
            setValue(date);
            router.get(route('payments.events.index', {
                month: date.month() + 1,
                year: date.year()
            }), {}, {
                preserveState: true,
                replace: true
            });
        }
    };
    dayjs.locale('ru-RU');
    console.log(locale);
    const cellRender = (current, info) => {
        if (info.type === 'date') return dateCellRender(current);
        return info.originNode;
    };
    return (
        <Calendar
            defaultValue={value}
            onPanelChange={handlePanelChange}
            cellRender={cellRender}
            locale={locale.Calendar}
        />
    )
};