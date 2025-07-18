import { useEffect, useState } from 'react';
import { LoadIco } from '@/components/icons'


export default function LoadingPage() {
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
            <LoadIco />
            <span>Загрузка ...</span>
        </div>
    )
}
