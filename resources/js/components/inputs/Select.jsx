import GroupComponent from "./GroupComponent";
import { Select } from "antd";


export default function SelectComponent({ id, name, options, label, onChange, value, disabled, mode }) {

    id = id ?? name

    return (
        <GroupComponent name={name} label={label}>
            <Select
                id={id}
                showSearch
                optionFilterProp={label}
                onChange={onChange}
                value={value}
                options={options}
                disabled={disabled}
                mode={mode}
            />
        </GroupComponent>
    )
}