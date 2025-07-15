import { Progress } from 'antd';
import { useState } from 'react';
import { router } from '@inertiajs/react';


export default function EchoProgress({ ...props }) {
    const statuses = {
        'job' : 'active',
        'done': 'success',
        'error': 'exception'
    }

    const [percent, setPercent] = useState(props.status === 'done' ? 100 : 0)
    const [status, setStatus] = useState(statuses[props.status])

    const chanel = props.chanel
    const event = props.event
    const type = props.type
    const size = props.size

    Echo.channel(chanel).listen(event, (data) => {
        setPercent(data.percent)
        setStatus(statuses[data.status])
        if (data.percent === 100)
            router.reload()
    })

    return (
        <Progress type={type} status={status} size={size} percent={percent} />
    )
}
