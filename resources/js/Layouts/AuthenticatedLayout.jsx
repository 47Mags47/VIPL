import Header from '@/includes/Header'
import LoadIco from '@/includes/LoadIco'
import Message from '@/includes/Messege'

import { message } from 'antd';


export default function AuthenticatedLayout({ children }) {

    const [messageApi, contextHolder] = message.useMessage();

    return (
        <div className="authenticated-layout">
            <LoadIco />
            <Header />
            <Message type='success' messageApi={messageApi} />
            {contextHolder}
            {children}
        </div>
    );
}
