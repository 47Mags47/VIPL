import { Table as AntdTable } from 'antd';
import TableSearch from '@/components/inputs/TableSearch'


export default function Table({ actions, searUrl, ...props }) {
    const paginate = { pageSize: 50 }

    return (
        <div className="table-box">
            <div className="top-side-box">
                <div className="search-box">
                    <TableSearch />
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
