import BaseForm from "./BaseForm"

export default function VerticalForm({action, method, header, children, info}) {
    return (
        <BaseForm action={action} method={method} header={header} type="vertical-form" info={info}>
            {children}
        </BaseForm>
    )
}