export default function BaseButton({ type, className, children, onClick, form, disabled }) {
    return (
        <button
            type={type}
            form={form}
            className={'button ' + className}
            onClick={onClick}
            disabled={disabled}
        >
            {children}
        </button>
    )
}
