import { useEcho } from '@laravel/echo-react';
import { Progress } from 'antd';
import { memo, useState } from 'react';

export default memo(function EchoProgress({ ...props }) {
    const statuses = {
        'job': 'active',
        'done': 'success',
        'error': 'exception'
    }

    const [percent, setPercent] = useState(props.status !== 'job' ? 100 : 0)
    const [status, setStatus] = useState(statuses[props.status])

    const chanel = props.chanel


    const type = props.type ?? 'circle'
    const size = props.size ?? 35

    useEcho(chanel, '.change-percent', (data) => setPercent(data.percent))
    useEcho(chanel, '.change-status', (data) => setStatus(statuses[data.status.type]))


    return (
        <Progress type={type} status={status} size={size} percent={percent} />
    )
})
