export default function BaseButton({type, className, children, onClick}) {
    return (
        <button type={type} className={'button ' + className} onClick={onClick}>
            {children}
        </button>
    )
}