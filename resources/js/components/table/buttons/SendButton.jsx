import { Link } from '@inertiajs/react'
import { SendIco } from '@/components/icons'


export default function SendButton({...props}) {
    return (
        <Link className="button blue-button send" {...props}>
            <SendIco />
        </Link>
    )
}
