import { usePage } from '@inertiajs/react'
import { useEffect, useState } from 'react'

const MESSAGE_TYPES = ['success', 'error', 'info', 'warning', 'loading']

export default function Message({ messageApi }) {
    const { flash } = usePage().props
    const [currentMessage, setCurrentMessage] = useState(null)
    const [currentType, setCurrentType] = useState('success')

    useEffect(() => {
        if (flash) {
            const messageType = MESSAGE_TYPES.find(type => flash[type] !== undefined)

            if (messageType && flash[messageType]) {
                const uniqueMessage = {
                    text: flash[messageType],
                    timestamp: Date.now(),
                }

                setCurrentMessage(uniqueMessage)
                setCurrentType(messageType)
            }
        }
    }, [flash])

    useEffect(() => {
        if (currentMessage && messageApi[currentType]) {
            messageApi[currentType]({
                content: currentMessage.text,
            })
        }
    }, [currentMessage, currentType, messageApi])

    return null
}
