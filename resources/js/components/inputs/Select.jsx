import GroupComponent from "./GroupComponent";


export default function Select({ id, name, selectValue, label }) {

    id = id ?? name

    return (
        <GroupComponent name={name} label={label}>
            <select name={name} id={id}>
                <option value={selectValue}></option>
            </select>
        </GroupComponent>
    )
}