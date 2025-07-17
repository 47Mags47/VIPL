import { usePage } from '@inertiajs/react'
import { useEffect } from 'react'
import { message } from 'antd';

export default function Message() {
    const flash_prop = usePage().props.flash
    const flash = Array.isArray(flash_prop) ? {} : flash_prop
    const [messageApi, contextHolder] = message.useMessage();

    useEffect(() => {
        Object.keys(flash).forEach((key) =>
            messageApi.open({
                type: key,
                content: flash[key],
            })
        )
    }, [flash])

    return (
        <>
            {contextHolder}
        </>
    )
}
