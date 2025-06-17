import { usePage } from '@inertiajs/react'
import { useEffect, useState } from 'react'


export default function Message({ messageApi }) {
    const { flash } = usePage().props

    const [currentMessage, setCurrentMessage] = useState(null)
    const [currentType, setCurrentType] = useState('success')

    useEffect(() => {
        if (flash && flash.message) {
            const uniqueMessage = {
                text: flash.message,
                timestamp: Date.now()
            }
            setCurrentMessage(uniqueMessage)
            setCurrentType(flash.type || 'success')
        }
    }, [flash])

    useEffect(() => {
        if (currentMessage) {
            messageApi[currentType]({
                content: currentMessage.text,
            })
        }
    }, [currentMessage, currentType, messageApi])

    return null
}
