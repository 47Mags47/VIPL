export default function Cell({ ...props }) {
    const key = props.key
    const row = props.data
    const column = props.column

    const render = Array.isArray(column.dataIndex)
        ? column.dataIndex.reduce((value, current) => value[current], row)
        : row[column.dataIndex]

    const classes = {
        'center': column.center,
        'has-button': column.button
    }

    let styles = {
        'width': {
            value: column.width + 'px',
            condition: column.width !== undefined
        }
    }

    for (let key in styles){
        if(!styles[key]['condition'])
            delete styles[key]
        else
            styles[key] = styles[key]['value']
    }

    return (
        <td
            key={key}
            className={Object.keys(classes).filter((key) => classes[key]).join(' ')}
            style={styles}
        >
            {
                typeof column.render === 'function'
                    ? column.render(column, row)
                    : render
            }
        </td>
    )
}
