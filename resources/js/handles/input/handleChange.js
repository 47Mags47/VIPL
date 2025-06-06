export default function handleChange(e, values, setValues) {
    const { name, value } = e.target

    let newValues = values
    Object.change(newValues, name.replace('[', '.').replace(']', ''), value)

    setValues({ ...newValues })   
}