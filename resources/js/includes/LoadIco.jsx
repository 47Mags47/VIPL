import { useEffect, useState } from 'react';


export default function LoadIco() {
    const [isLoading, setIsLoading] = useState(true)

    useEffect(() => {
        if (document.readyState === 'complete') {
            const timer = setTimeout(() => setIsLoading(false), 500)
            return () => clearTimeout(timer)
        } else {
            const handleWindowLoad = () => {
                const timer = setTimeout(() => setIsLoading(false), 500)
                return () => clearTimeout(timer)
            }
            window.addEventListener('load', handleWindowLoad)
            return () => {
                window.removeEventListener('load', handleWindowLoad)
            }
        }
    }, [])

    if (!isLoading) return null
    return (
        <div className="load-ico-box open">
            <i className="fa-solid fa-spinner fa-spin"></i>
            <span>Загрузка ...</span>
        </div>
    )
}
