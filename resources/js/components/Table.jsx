// DELETE Компонент является устаревшим и будет удален, замена на '@/components/table'

import { Table as AntdTable } from 'antd';
import TableSearch from '@/components/inputs/TableSearch'


export default function Table({ only, current_page, last_page, from, actions, searUrl, ...props }) {
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
                    <TableSearch only={only}/>
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
