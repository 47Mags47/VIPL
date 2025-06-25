export default function BaseButton({...props}) {
    // let props2 = {...props, className: 'button ' + props.className}
    // console.log(props2);
    
    return (
        <button
            {...props}
            className={'button ' + props.className}
        >
        { props.children }
        </button >
    )
}
