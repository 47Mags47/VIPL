export default function handleSelectChange(name, value, values, setValues) {
    let newValues = values
    Object.change(newValues, name, value)
    setValues({...newValues})      
}
