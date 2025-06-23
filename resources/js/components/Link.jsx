export default function Link({ onClick, name, children, className }) {
    return (
        <button className={className ?? 'link'}>
            <span className={name} onClick={onClick}>{children}</span>
        </button>

    )
}