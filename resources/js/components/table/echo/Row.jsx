import { useEcho } from '@laravel/echo-react'
import Cell from './Cell'

export default function Row({ ...props }) {
    const key = props.key
    const data = props.data
    const columns = props.columns
    const channel = props.channel
    const realtime = props.realtime
    const setActuality = props.setActuality
    const dataKey = props.dataKey


    if (channel !== undefined) {
        useEcho(
            channel,
            '.update',
            () => realtime
                ? router.reload({ only: [dataKey] })
                : setActuality(false)
        );
    }


    return (
        <tr key={key}>
            {
                columns.map((column, i) => (
                    <Cell key={i} column={column} data={data} />
                ))
            }
        </tr>
    )
}
