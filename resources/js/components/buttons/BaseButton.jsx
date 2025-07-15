export default function BaseButton({ ...props }) {
    const type = props.type ?? 'button'
    const className = 'button ' + props.className
    const onClick = props.onClick
    const disabled = props.disabled
    const style = props.style

    return (
        <button
            type={type}
            className={className}
            onClick={onClick}
            disabled={disabled}
            style={style}
        >
            {props.children}
        </button >
    )
}
