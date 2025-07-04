import { Link } from '@inertiajs/react'
import { EditIco } from '@/components/icons'

export default function EditButton({...props}) {

    return(
        <Link className="button blue-button" {...props}>
            <EditIco/>
        </Link>
    )
}
