import BlueButton from "../button/BlueButton";
import Error from "../Error";
import { usePage } from '@inertiajs/react';

export default function BaseForm({
    header,
    children,
    info,
    type,
    sbm,
    handleSubmit,
    id
}) {
    const { errors } = usePage().props;

    return (
        <div className={"form-container " + (type ?? '')}>
            <form onSubmit={handleSubmit} id={id}>
                <h3 className="form-header">{header}</h3>
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
};
