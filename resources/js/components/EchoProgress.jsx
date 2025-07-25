import { Progress } from 'antd';
import { useState } from 'react';

export default function EchoProgress({ ...props }) {
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

    // Echo.channel(chanel)
    //     .listen('.change-percent', (data) => setPercent(data.percent))
    //     .listen('.change-status', (data) => setStatus(statuses[data.file.status.type]))

    return (
        <Progress type={type} status={status} size={size} percent={percent} />
    )
}
