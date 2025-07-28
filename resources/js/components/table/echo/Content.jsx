import Thead from './Thead'
import Tbody from './Tbody'

import '@/../sass/components/table/echo/content.sass'

export default function Content({ ...props }) {
    const rows = props.rows
    const columns = props.columns
    const itemChannel = props.itemChannel
    const realtime = props.realtime
    const setActuality = props.setActuality
    const dataKey = props.dataKey

    return (
        <div className="table-content">
            <table>
                <Thead headers={columns.map((column) => column.title)} />
                <Tbody
                    rows={rows}
                    columns={columns}
                    itemChannel={itemChannel}
                    realtime={realtime}
                    setActuality={setActuality}
                    dataKey={dataKey}
                />
            </table>
        </div>
    )
}
