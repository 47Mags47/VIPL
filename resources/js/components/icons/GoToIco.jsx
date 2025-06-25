import { Link } from '@inertiajs/react'


export default function GoToIco({href}) {
    return (
        <div className='button blue-button ico'>
            <Link
                href={href}
                method='get'
            >
                <i className="fa-solid fa-arrow-right ico ico-goto"></i>
            </Link>
        </div >
    )
}
