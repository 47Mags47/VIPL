export default function BaseButton({ ...props }) {
    return (
        <button
            {...props}
            className={'button ' + props.className}
        >
            {props.children}
        </button >
    )
}
