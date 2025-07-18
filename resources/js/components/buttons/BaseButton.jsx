export default function BaseButton({ ...props }) {
    const type = props.type ?? 'button'
    const className = 'button ' + props.className
    const onClick = props.onClick
    const disabled = props.disabled
    const style = props.style
    const actionConfirm = props.confirm

    function clickHandler() {
        if (actionConfirm !== undefined)
            if (!confirm(actionConfirm))
                return

        if (typeof onClick === 'function')
            onClick()
    }

    return (
        <button
            type={type}
            className={className}
            onClick={clickHandler}
            disabled={disabled}
            style={style}
        >
            {props.children}
        </button >
    )
}
