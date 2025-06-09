import { usePage } from "@inertiajs/react";


export default function Flash() {
    const messages = usePage().props.flash

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
