import BaseForm from "./BaseForm";


export default function VerticalForm(
    { ...props }
) {
    const header = props.header

    const info = props.info
    const sbm = props.sbm

    const handleSubmit = props.handleSubmit

    return (
        <BaseForm
            header={header}
            className="vertical-form"
            info={info}
            sbm={sbm}
            handleSubmit={handleSubmit}
        >
            {props.children}
        </BaseForm>
    );
}
