import { Link } from '@inertiajs/react'
import { AddIco } from '@/components/icons'


export default function AddButton({...props}) {
    return (
        <Link className="button blue-button" {...props}>
            <AddIco/>
        </Link>
    )
}
