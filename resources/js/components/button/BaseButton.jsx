// DELETE Компонент является устаревшим и будет удален, замена на '@/components/buttons/BaseButton'

export default function BaseButton({...props}) {

    return (
        <button
            {...props}
            className={'button ' + props.className}
        >
        { props.children }
        </button >
    )
}
