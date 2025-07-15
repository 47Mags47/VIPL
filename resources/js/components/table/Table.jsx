import { Table as AntdTable } from 'antd';

import Search from './Search';
import { router } from '@inertiajs/react';

export default function Table({ ...props }) {
    const rowKey = props.rowKey ?? 'id'
    const columns = props.columns
    const dataSource = props.data.data ?? []
    const pagination = {
        position: ['bottomRight'],
        current: props.data.meta.current_page,
        total: props.data.meta.total,
        pageSize: props.data.meta.per_page,
        hideOnSinglePage: true,
        showSizeChanger: false,
        onChange: (current) => router.get(location.href, { 'page': current }, { preserveState: true, reset: true }),
        itemRender: (_, type, originalElement) => {
            if (type === 'prev' && props.data.links.prev === null)
                return null

            if (type === 'next' && props.data.links.next === null)
                return null

            return originalElement
        },
    }
    const Actions = () => props.actions


    return (
        <div className="table-box">
            <div className="table-before-box">
                <div className="search-box">
                    <Search />
                </div>
                <div className="actions-box">
                    <Actions />
                </div>
            </div>
            <div className="table-content-box">
                <AntdTable
                    rowKey={rowKey}
                    columns={columns}
                    dataSource={dataSource}
                    pagination={pagination}
                />
            </div>
        </div >
    );
};
