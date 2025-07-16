export default function Baselayout({...props}) {
    name= props.name ?? ''

    return (
        <div className={"layout " + name}>
            {props.children}
        </div>
    );
}
