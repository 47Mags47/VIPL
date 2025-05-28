export default function Button({type, nameBtn, textBtn}) {
    return (
        <button type={type} className={nameBtn}>
            {textBtn}
        </button>
    )
}