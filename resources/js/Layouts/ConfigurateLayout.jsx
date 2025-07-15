// DELETE Компонент является устаревшим и будет удален, замена на '@/components/lauouts/ConfigurateLayout'

import Header from '@/includes/Header'
import LoadIco from '@/includes/LoadIco'
import Message from '@/includes/Messege'

import { message } from 'antd';

export default function ConfigurateLayout() {
    const [messageApi, contextHolder] = message.useMessage();

    return (
        <div className="layout configurate-layout">
            <LoadIco />
            <Header />
            <Message type='success' messageApi={messageApi} />
            {contextHolder}
            <main>
                {children}
            </main>
        </div>
    )
}
