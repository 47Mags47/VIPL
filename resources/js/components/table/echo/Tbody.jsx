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
        if(typeof itemChannel === 'undefined')
            return

        let matches = itemChannel.match(/(?<=\{)[^\{\}]*(?=\})/g) ?? []

        if(matches === null)
            return

        return matches.reduce(
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
