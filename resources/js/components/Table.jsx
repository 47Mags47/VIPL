import { Table as AntdTable } from 'antd';
import TableSearch from '@/components/inputs/TableSearch'


export default function Table({ current_page, last_page, from, actions, searUrl, filterKey, ...props }) {
    const itemRender = (_, type, originalElement) => {
        if (type === 'prev' && current_page === 1) {
            return null
        }
        if (type === 'next' && current_page === last_page) {
            return null
        }
        return originalElement;
    };
    const paginate = {
        pageSize: 50,
        hideOnSinglePage: true,
        itemRender: itemRender,
    }
    return (
        <div className="table-box">
            <div className="top-side-box">
                <div className="search-box">
                    <TableSearch filterKey={filterKey} />
                </div>
                <div className="actions-box">
                    {actions}
                </div>
            </div>
            <div className="table-content-box">
                <AntdTable {...props} pagination={paginate} />
            </div>
        </div >
    );
};
