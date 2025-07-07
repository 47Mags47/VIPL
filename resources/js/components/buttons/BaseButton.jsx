export default function BaseButton({ ...props }) {
    const type = props.type ?? 'button'
    const className = 'button ' + props.className
    const onClick = props.onClick

    return (
        <button
            type={type}
            className={className}
            onClick={onClick}
        >
            {props.children}
        </button >
    )
}
