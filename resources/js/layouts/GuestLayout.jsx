import LoadIco from '@/includes/LoadIco'
import Message from '@/includes/Messege'

export default function GuestLayout({ children }) {
    const [messageApi, contextHolder] = message.useMessage();

    return (
        <div className="layout guest-layout">
            <LoadIco />
            <Message type='success' messageApi={messageApi} />
            {contextHolder}
            {children}
        </div>
    );
}
