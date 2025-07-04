import { usePage } from '@inertiajs/react';

import BlueButton from "@/components/buttons/BlueButton";


export default function BaseForm({ ...props }) {
    const className = props.className
    const boxClassName = props.className !== undefined
        ? props.className + '-box'
        : ''

    const Header = () => props?.header && (<h3 className="form-header">{props.header}</h3>)
    const Errors = () => usePage().props.errors?.form && (<Error name="form" />)
    const Info = () => props.info
    const Sbm = () => props?.sbm && (<BlueButton type="submit">{props.sbm}</BlueButton>)

    const handleSubmit = props.handleSubmit

    return (
        <div className={"form-container " + boxClassName}>
            <form onSubmit={handleSubmit} className={className}>
                <Header />
                <div className="form-errors">
                    <Errors />
                </div>
                <div className="form-content">
                    {props.children}
                </div>
                <div className="form-buttons">
                    <Sbm />
                </div>
                <div className="form-backside">
                    <Info />
                </div>
            </form>
        </div>
    );
};
