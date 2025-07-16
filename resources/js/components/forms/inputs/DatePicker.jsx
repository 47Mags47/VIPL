import locale from 'antd/locale/ru_RU'
import dayjs from 'dayjs'
import 'dayjs/locale/ru'

import Label from "./Label"
import { DatePicker as Date } from 'antd'

export default function DatePicker({ ...props }) {
    const name = props.name
    const label = props.label
    const multiple = props.multiple ?? false
    const value = toDate(props.value)
    const onChange = props.onChange
    const format = props.format ?? 'DD.MM.YYYY'

    function toString(date) {
        return Array.isArray(props.value)
            ? date.map((day) => day.format('YYYY-MM-DD HH:mm:ss'))
            : date.format('YYYY-MM-DD HH:mm:ss')
    }

    function toDate(date) {
        return Array.isArray(props.value)
            ? date.map((day) => dayjs(day, 'YYYY-MM-DD HH:mm:ss'))
            : (date !== '' ? dayjs(date, 'YYYY-MM-DD HH:mm:ss') : '')
    }

    function changeHandler(date) {
        onChange(date !== null ? toString(date) : (multiple ? [] : ''))
    }


    return (
        <Label name={name} label={label} >
            <Date
                value={value}
                onChange={changeHandler}
                locale={locale.Calendar}
                placeholder={format.replace(/[a-zA-Z]/g, '_')}
                multiple={multiple}
                classNames={{
                    root: 'date-picker',
                    popup: { root: 'date-picker-popup' }
                }}
                format={{
                    format: format,
                    type: 'mask',
                }}

            />
        </Label>
    )
}
