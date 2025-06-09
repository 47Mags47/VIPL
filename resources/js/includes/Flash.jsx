import { usePage } from "@inertiajs/react";
import { useEffect } from "react";

export default function Flash() {
    const messages = usePage().props.flash

    useEffect(() => {
        openFlash()
    }, [messages])

    return (
        <div className="flash-message-box">
            {Object.keys(messages).map((key, index) => {
                return (
                    <div className={'flash-message ' + key} key={index}>{messages[key]}</div>
                )
            })}
        </div>
    )
}
