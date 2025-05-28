import GroupComponent from "./GroupComponent";

export default function Input ({type, id, name, value, placeholder, handleInputChange, label}){

    return(
        <GroupComponent name={name} label={label}>
            <input type={type} id={id} name={name} value={value} onChange={handleInputChange} placeholder={placeholder} />
        </GroupComponent>
    )
}
