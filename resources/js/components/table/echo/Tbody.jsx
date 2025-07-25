import Row from './Row'

import '@/../sass/components/table/echo/tbody.sass'

export default function Tbody({ ...props }) {
    const rows = props.rows
    const columns = props.columns
    const itemChannel = props.itemChannel
    const realtime = props.realtime
    const setActuality = props.setActuality
    const dataKey = props.dataKey

    function getItemChannel(item) {
        return itemChannel
            .match(/(?<=\{)[^\{\}]*(?=\})/g)
            .reduce(
                (value, attribute) => value.replace('{' + attribute + '}', item[attribute]),
                itemChannel
            )
    }

    return (
        <tbody>
            {
                rows.map((row, i) => (
                    <Row
                        key={'table-row-' + i}
                        data={row}
                        columns={columns}
                        channel={getItemChannel(row)}
                        realtime={realtime}
                        setActuality={setActuality}
                        dataKey={dataKey}
                    />
                ))
            }
        </tbody>
    )
}
