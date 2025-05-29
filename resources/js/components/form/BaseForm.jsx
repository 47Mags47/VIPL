import HandleForm from "./handleForm";
import Button from "./Button";
import Error from "../FormError";
import React from "react";


export default function BaseForm({ action, method, header, children, info, type }) {
    const { values, handleSubmit, handleInputChange, errors } = HandleForm();

    const childrenWithProps = React.Children.map(children, child => {
        if (!React.isValidElement(child)) return child;

        const { name } = child.props || {};
        if (!name) return child;

        return React.cloneElement(child, {
            value: values[name] || '',
            onChange: handleInputChange
        });
    });

    return (
        <div className={"form-container " + (type ?? '')}>
            <form onSubmit={handleSubmit(action)} method={method}>
                <h3 className="form-header">{header}</h3>
                <div className="form-params">
                    <input type="hidden" name="_token" value={token()} />
                </div>
                {errors?.form && (
                    <div className="form-errors">
                        <Error name="form" />
                    </div>
                )}
                <div className="form-content">
                   {childrenWithProps}
                </div>
                <div className="form-buttons">
                    <Button type="submit" nameBtn="submit-btn" textBtn="Войти"/>
                </div>
                <div className="form-backside">
                    {info ?? ''}
                </div>
            </form>
        </div>
    );
}
