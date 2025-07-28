import { router, usePage } from "@inertiajs/react"
import { useState } from "react"
import { useEcho } from "@laravel/echo-react"

import { Header as DefaultHeader } from './'
import { Footer as DefaultFooter } from './'
import { Content as DefaultContent } from './'

import '@/../sass/components/table/echo/table.sass'

export default function Table({ ...props }) {
    // Data
    const dataKey = props.dataKey
    const data = props.data ?? usePage().props[dataKey]
    const rows = data.data
    const columns = props.columns
    const paginate = {
        current: data.meta?.current_page ?? 1,
        total: data.meta?.total ?? 50,
        pageSize: data.meta?.per_page ?? 50,
        lastPage: data.meta?.last_page ?? 1,
    }


    // Channels
    const realtime = props.realtime ?? false
    const channels = props.channels
    const listChannel = props.listChannel ?? channels?.listChannel
    const itemChannel = props.itemChannel ?? channels?.itemChannel

    const [actuality, setActuality] = useState(true)

    if (listChannel !== undefined)
        useEcho(
            listChannel,
            '.update-list',
            () => realtime
                ? router.reload({ only: [dataKey] })
                : setActuality(false)
        );

    // Render
    function Header() {
        const actions = props.actions ?? function () { return (<></>) }
        const filters = props.filters ?? function () { return (<></>) }
        const CustomHeader = props.HeaderRender

        return typeof props.HeaderRender === 'function'
            ? <CustomHeader test={'test'} />
            : <DefaultHeader
                actions={actions}
                filters={filters}
                actuality={actuality}
                realtime={realtime}
                setActuality={setActuality}
                paginate={paginate}
                datakey={dataKey}
            />
    }

    function Content() {
        const CustomContent = props.ContentRender

        return typeof props.ContentRender === 'function'
            ? <CustomContent />
            : <DefaultContent
                rows={rows}
                columns={columns}
                itemChannel={itemChannel}
                realtime={realtime}
                setActuality={setActuality}
                datakey={dataKey}
            />
    }

    function Footer() {
        const CustomFooter = props.FooterRender

        return typeof props.FooterRender === 'function'
            ? <CustomFooter />
            : <DefaultFooter
                paginate={paginate}
                datakey={dataKey}
            />
    }


    return (
        <div className="table-box">
            <Header />
            <Content />
            <Footer />
        </div>
    )
}
