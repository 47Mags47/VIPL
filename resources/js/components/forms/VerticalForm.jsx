import BaseForm from "./BaseForm";


export default function VerticalForm({ ...props }) {
    return (
        <BaseForm
            className="vertical-form"
            {...props}
        />
    );
}
