import Thead from './Thead'
import Tbody from './Tbody'

import '@/../sass/components/table/echo/content.sass'

export default function Content({ ...props }) {
    const rows = props.rows
    const columns = props.columns


    return (
        <div className="table-content">
            <table>
                <Thead headers={columns.map((column) => column.title)} />
                <Tbody rows={rows} columns={columns}/>
            </table>
        </div>
    )
}
