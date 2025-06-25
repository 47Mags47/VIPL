import BaseForm from "./BaseForm";


export default function VerticalForm({
    className,
    buttonName,
    method,
    header,
    children,
    info,
    sbm,
    params,
    handleSubmit,
    id
}) {
    return (
        <BaseForm
            method={method}
            header={header}
            type="vertical-form"
            className={className}
            buttonName={buttonName}
            info={info}
            sbm={sbm}
            params={params}
            handleSubmit={handleSubmit}
            id={id}
        >
            {children}
        </BaseForm>
    );
}
