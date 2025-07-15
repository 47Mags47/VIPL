export default function List({ ...props }) {
    const value = props.value
    const Footer = props.footer ?? function () { return (<></>) }

    const itemRender = props.itemRender ?? defaultItemRender

    function defaultItemRender(item, index) {
        return (
            <span>{item}</span>
        )
    }

    return (
        <div className="list-box">
            <ul className="list">
                {value.map((item, index) => (
                    <li key={index}>
                        {itemRender(item, index)}
                    </li>
                ))}
            </ul>
            <Footer />
        </div>
    )
}
