import Error                    from '@/components/Error'
import { StringInput as Input } from '@/components/forms'
import RedButton                from '@/components/buttons/RedButton'
import TrashIco                 from '@/components/icons/TrashIco'


export default function ListItem({...props}) {
    const value = props.value || ''
    const index = props.index
    const editing = props.editing
    const setEditing = props.setEditing
    const onDeleteClick = props.onDeleteClick
    const handleChange = props.handleChange
    const name = props.name

    const onBlur = (e) => {
        if (!e.target.value.trim())
            onDeleteClick(e, index)
        else
            setEditing(false)
    }

    return (
        <div
            className="list-item"
            onDoubleClick={() => setEditing(true)}
        >
            <div className="left">
                {editing ? (
                    <Input
                        name={`${name}[${index}]`}
                        value={value }
                        onChange={(e) => handleChange(e, index)}
                        onBlur={onBlur}
                        placeholder="Введите значение"
                        autoFocus
                    />
                ) : (
                    <div className="label-list span">
                        <span>{value || '...'}</span>
                        <Error name={`${name}.${index}`} />
                    </div>
                )}
            </div>

            <RedButton onClick={(e) => onDeleteClick(e, index)}>
                <TrashIco />
            </RedButton>
        </div>
    )
}
