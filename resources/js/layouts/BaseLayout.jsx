import LoadIco from '@/includes/LoadIco'
import Message from '@/includes/Messege'

export default function Baselayout({ ...props }) {
    name = props.name ?? ''

    return (
        <div className={"layout " + name}>
            <LoadIco />
            <Message />
            {props.children}
        </div>
    )
}
