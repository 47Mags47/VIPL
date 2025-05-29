import GroupComponent from "./GroupComponent";

export default function Input ({type, id, name, value, placeholder,onChange, label}){
    return(
        <GroupComponent name={name} label={label}>
            <input type={type} id={id} name={name} value={value} onChange={onChange} placeholder={placeholder} />
        </GroupComponent>
    )  
}