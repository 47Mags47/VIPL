import locale from 'antd/locale/ru_RU'
import dayjs from 'dayjs'
import 'dayjs/locale/ru'

import Label from "./Label"
import { DatePicker as Date } from 'antd'

export default function DatePicker({ ...props }) {
    const name = props.name
    const label = props.label
    const value = props.value
    const onChange = props.onChange

    dayjs.locale('ru')

    return (
        <Label name={name} label={label} >
            <Date
                classNames={{
                    root: 'date-picker',
                    popup: { root: 'date-picker-popup' }
                }}
                value={dayjs(value, 'DD-MM-YYYY') ?? ''}
                onChange={onChange}
                locale={locale.Calendar}
                placeholder='__-__-____'
                format={{
                    format: 'DD-MM-YYYY',
                    type: 'mask',
                }}
                {...props}
            />
        </Label>
    )
}
