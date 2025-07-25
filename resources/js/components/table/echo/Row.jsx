import Cell from './Cell'

export default function Row({...props}){
    const key = props.key
    const data = props.data
    const columns = props.columns

    return (
        <tr key={key}>
            {
                columns.map((column, i) => (
                    <Cell key={i} column={column} data={data}/>
                ))
            }
        </tr>
    )
}
