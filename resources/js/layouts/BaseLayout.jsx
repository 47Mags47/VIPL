import LoadingPage from '@/includes/LoadingPage'
import Message from '@/includes/Messege'

export default function Baselayout({ ...props }) {
    name = props.name ?? ''

    return (
        <div className={"layout " + name}>
            <LoadingPage />
            <Message />
            {props.children}
        </div>
    )
}
