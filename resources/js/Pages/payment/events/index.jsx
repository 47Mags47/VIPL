import { usePage, router, Link }        from '@inertiajs/react'
import { useState }                     from 'react'

import { Badge, Calendar }              from 'antd'
import locale                           from 'antd/locale/ru_RU'
import dayjs                            from 'dayjs'
import                                  'dayjs/locale/ru'

import{ AuthenticatedLayout as Layout}  from '@/layouts'
import BlueButton                       from '@/components/buttons/BlueButton'
import Select                           from '@/components/forms/inputs/Select'


export default function Index() {
    const events = usePage().props.events

    const [value, setValue] = useState(dayjs())

    dayjs.locale('ru')

    const getListData = (value) => {
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

    const dateCellRender = (value) => {
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
            setValue(date)

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

    const cellRender = (current, info) => {
        if (info.type === 'date') return dateCellRender(current)
        return info.originNode
    }

    const headerRender = ({ value, onChange }) => {
        const current = value.locale('ru')
        const month = current.month()
        const year = current.year()
        const isToday = current.isSame(dayjs(), 'day')

        const months = current.localeData().months().map(m =>
            m.charAt(0).toUpperCase() + m.slice(1)
        )

        const monthOptions = months.map((label, index) => ({
            label,
            value: index,
        }))

        const yearOptions = Array.from({ length: 11 }, (_, i) => {
            const years = year - 5 + i
            return { label: `${years}`, value: years }
        })

        const changeMonth = (newMonth) => {
            const newValue = current.month(newMonth)
            onChange(newValue)
            router.get(route('payments.events.index', {
                month: newValue.month() + 1,
                year: newValue.year()
            }), {}, {
                preserveState: true,
                replace: true
            })
        }

        const changeYear = (newYear) => {
            const newValue = current.year(newYear)
            onChange(newValue)
            router.get(route('payments.events.index', {
                month: newValue.month() + 1,
                year: newValue.year()
            }), {}, {
                preserveState: true,
                replace: true
            })
        }

        return (
            <div className={'calendar-header'}>
                <div className={'calendar-select-group'}>
                    <Select
                        value={year}
                        options={yearOptions}
                        onChange={changeYear}
                        popupMatchSelectWidth={false}
                    />
                    <Select
                        value={month}
                        options={monthOptions}
                        onChange={changeMonth}
                        popupMatchSelectWidth={false}
                    />
                </div>
                <div className='calendar-action'>
                    <BlueButton onClick={goToCurrentMonth}>
                        Текущий месяц
                    </BlueButton>
                </div>
            </div>
        )
    }

    return (
        <Layout>
            <Calendar
                headerRender={headerRender}
                value={value}
                onPanelChange={handlePanelChange}
                cellRender={cellRender}
                locale={locale.Calendar}
            />
        </Layout>
    )
}
