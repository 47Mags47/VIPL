export default function Button(type, nameBtn, textBtn) {
    return (
    <div className="form-buttons">
        <button type={type} className={nameBtn}>
            {textBtn}
        </button>
    </div>
    )
}