export default function BaseButton({type, className, children, onClick, form}) {
    return (
        <button type={type} form={form} className={'button ' + className} onClick={onClick}>
            {children}
        </button>
    )
}
