import Row from './Row'

import '@/../sass/components/table/echo/tbody.sass'

export default function Tbody({ ...props }) {
    const rows = props.rows
    const columns = props.columns

    return (
        <tbody>
            {
                rows.map((row, i) => (
                    <Row key={'table-row-' + i} data={row} columns={columns} />
                ))
            }
        </tbody>
    )
}
