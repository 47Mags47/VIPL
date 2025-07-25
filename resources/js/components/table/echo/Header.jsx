import { Pagination } from 'antd';

import { RefreshIco } from '@/components/icons';
import { BlueButton } from '@/components/buttons';

import Search from './Search';
import { router } from '@inertiajs/react';

import '@/../sass/components/table/echo/header.sass'

export default function Header({ ...props }) {
    const Actions = props.actions
    const Filters = props.filters
    const actuality = props.actuality
    const realtime = props.realtime
    const setActuality = props.setActuality

    function refresh() {
        router.reload()
        setActuality(true)
    }

    const paginate = props.paginate
    const datakey = props.datakey

    return (
        <div className="table-header">
            <div className="filters-box">
                <Filters />
            </div>
            <div className="search-box">
                <Search />
            </div>
            <div className="paginate-box">
                {paginate.lastPage !== 1 ?
                    <Pagination
                        showSizeChanger={false}
                        current={paginate.current}
                        pageSize={paginate.pageSize}
                        total={paginate.total}
                        onChange={(page) => router.reload({ only: [datakey], data: { page: page } })}
                        simple
                    />
                    : ''
                }
            </div>
            <div className="actions-box">
                <Actions />
                {(realtime === false && actuality === false)
                    ? <BlueButton onClick={refresh}><RefreshIco /></BlueButton>
                    : ''
                }
            </div>
        </div>
    )
}
