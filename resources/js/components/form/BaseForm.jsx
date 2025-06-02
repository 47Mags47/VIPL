import React, { forwardRef, useState } from 'react';
import BlueButton from "../button/BlueButton";
import Error from "../Error";
import { usePage } from '@inertiajs/react';


const BaseForm = forwardRef(({ method, header, children, info, type, sbm, params, onSubmit }, ref) => {
    const { errors } = usePage().props;

    let formMethod = 'GET'
    let startParams = ''

    if (method == 'get' || method == 'GET') {
        formMethod = 'GET'
    } else if (method == 'post' || method == 'POST') {
        formMethod = 'POST'

        startParams = (
            <input type="hidden" name="_token" value={token()} />
        )
    } else if (method == 'put' || method == 'PUT') {
        formMethod = 'POST'

        startParams = (
            <>
                <input type="hidden" name="_token" value={token()} />
                <input type="hidden" name="_method" value="PUT" />
            </>
        )
    }

    return (
        <div className={"form-container " + (type ?? '')}>
            <form ref={ref} action={ onSubmit }>
                <h3 className="form-header">{header}</h3>
                <div className="form-params">
                    {startParams}
                </div>
                {errors?.form && (
                    <div className="form-errors">
                        <Error name="form" />
                    </div>
                )}
                <div className="form-content">
                    {children}
                </div>
                <div className="form-buttons">
                    {sbm && <BlueButton type="submit">{sbm}</BlueButton>}
                </div>
                <div className="form-backside">
                    {info ?? ''}
                </div>
            </form>
        </div>
    );
});

export default BaseForm;
