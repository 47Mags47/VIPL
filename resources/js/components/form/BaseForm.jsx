import HandleForm from "./handleForm";
import Button from "./Button";
import Error from "../FormError";

export default function BaseForm({ action, method, header, children, info, type }) {
    const { values, handleSubmit, errors } = HandleForm();

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
                   {children}
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
