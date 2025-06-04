import { forwardRef } from 'react';
import BaseForm from "./BaseForm";

const VerticalForm = forwardRef(({
    method,
    header,
    children,
    info,
    sbm,
    params,
    handleSubmit,
    id
}, ref) => {
    return (
        <BaseForm
            ref={ref}
            method={method}
            header={header}
            type="vertical-form"
            info={info}
            sbm={sbm}
            params={params}
            handleSubmit={handleSubmit}
            id={id}
        >
            {children}
        </BaseForm>
    );
});

export default VerticalForm;
