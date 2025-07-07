import Label from "./Label";
import { Select } from "antd";


export default function SelectComponent({ ...props }) {
    const name = props.name
    const id = props.id ?? props.name
    const label = props.label
    const value = props.value
    const disabled = props.disabled
    const options = props.options ?? props.list.map(item => ({
        value: item[props.item_key] ?? item.id,
        label: item[props.item_value] ?? item.value,
    }))
    const onChange = props.onChange
    const filterOption = (input, option) => (option?.label ?? '').toLowerCase().includes(input.toLowerCase())


    return (
        <Label name={name} label={label}>
            <Select
                showSearch
                id={id}
                defaultValue={value}
                onChange={onChange}
                disabled={disabled}
                options={options}
                filterOption={filterOption}
            />
        </Label>
    )
}
