import BaseLayout from './BaseLayout'

import Header from '@/includes/Header'
import LoadIco from '@/includes/LoadIco'
import Message from '@/includes/Messege'

import { message } from 'antd'


export default function AuthenticatedLayout({ children }) {
    const [messageApi, contextHolder] = message.useMessage()

    return (
        <BaseLayout name="authenticated-layout">
            <LoadIco />
            <Header />
            <Message type='success' messageApi={messageApi} />
            {contextHolder}
            <main>
                {children}
            </main>
        </BaseLayout>
    );
}
