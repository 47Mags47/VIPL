import { Table as AntdTable } from 'antd';

import Search from './Search';

export default function Table({ ...props }) {
    const rowKey = props.rowKey ?? 'id'
    const columns = props.columns
    const dataSource = props.data.data ?? []
    const pagination = {
        pageSize: props.data.meta.per_page,
        hideOnSinglePage: true,
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
