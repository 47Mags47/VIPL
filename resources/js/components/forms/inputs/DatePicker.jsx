import locale from 'antd/locale/ru_RU'
import dayjs from 'dayjs'
import 'dayjs/locale/ru'

import Label from "./Label"
import { DatePicker as Date } from 'antd'

export default function DatePicker({ ...props }) {
    const name = props.name
    const label = props.label
    const value = props.value !== ''
        ? dayjs(props.value, 'YYYY-MM-DD HH:mm:ss')
        : ''

    const onChange = props.onChange
    const format = props.format ?? 'DD.MM.YYYY'

    function changeHandler(date, str) {
        onChange(date.format('YYYY-MM-DD HH:mm:ss'))
    }

    return (
        <Label name={name} label={label} >
            <Date
                classNames={{
                    root: 'date-picker',
                    popup: { root: 'date-picker-popup' }
                }}
                value={value}
                onChange={changeHandler}
                locale={locale.Calendar}
                placeholder={format.replace(/[a-zA-Z]/g, '_')}
                format={{
                    format: format,
                    type: 'mask',
                }}
            />
        </Label>
    )
}
