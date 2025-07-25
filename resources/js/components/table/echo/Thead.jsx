import '@/../sass/components/table/echo/thead.sass'

export default function Thead({ ...props }) {
    const headers = props.headers


    return (
        <thead>
            <tr>
                {
                    headers.map((header, i) => (
                        <th key={'table-th-' + i}>{header}</th>
                    ))
                }
            </tr>
        </thead>
    )
}
