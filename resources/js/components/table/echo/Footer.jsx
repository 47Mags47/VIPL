import { router } from '@inertiajs/react';
import { Pagination } from 'antd';

export default function Header({ ...props }) {
    const paginate = props.paginate
    const datakey = props.datakey

    const itemRender = (_, type, originalElement) => {
        if (type === 'prev' && paginate.current === 1)
            return null

        if (type === 'next' && paginate.current === paginate.lastPage)
            return null

        return originalElement
    }

    return (
        <div className="table-footer">
            {paginate.lastPage !== 1 ?
                <Pagination
                    showSizeChanger={false}
                    current={paginate.current}
                    pageSize={paginate.pageSize}
                    total={paginate.total}
                    itemRender={itemRender}
                    align="center"
                    onChange={(page) => router.reload({ only: [datakey], data: { page: page } })}
                />
                : ''
            }
        </div>
    )
}
