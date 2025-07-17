export default function StatusCircle({ ...props }) {
    const title = props.title ?? ''
    const color = {
        'green': '#5cf561',
        'orange': '#f3f55c',
        'red': '#f53b3b',
        'black': '#000000'
    }[props.color ?? 'black']


    return (
        <div
            className="status status-circle"
            style={{ background: color }}
            title={title}
        ></div>
    )
}
