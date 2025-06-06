export default function Link({onClick, name, children}){
    return(
        <span className={name} onClick={onClick}>{children}</span>
    )
}