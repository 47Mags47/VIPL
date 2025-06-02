import { forwardRef } from 'react';
import BaseForm from "./BaseForm";

const VerticalForm = forwardRef(({ method, header, children, info, sbm, params, onSubmit }, ref) => {
    return (
        <BaseForm
            ref={ref}
            method={method}
            header={header}
            type="vertical-form"
            info={info}
            sbm={sbm}
            params={params}
            onSubmit={onSubmit}
        >
            {children}
        </BaseForm>
    );
});

export default VerticalForm;
