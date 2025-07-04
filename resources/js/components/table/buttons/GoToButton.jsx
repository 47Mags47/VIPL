import { Link } from '@inertiajs/react'
import { GoToIco } from '@/components/icons'


export default function GoToButton({...props}) {
    return (
        <Link className="button blue-button" {...props}>
            <GoToIco/>
        </Link>
    )
}
