import handleChange from './handleChange'
export default function GroupComponent(htmlFor,labelName, type, value, placeholder ){
    return(
    <div className="form-group">
        <label htmlFor={htmlFor}>{labelName}</label>
        <input type={type} id={type} name={type} value={value} onChange={handleChange} placeholder={placeholder} />
        {/* {errors.email && <div>{errors.email}</div>} */}
    </div>
    )
}