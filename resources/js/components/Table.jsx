import { router } from '@inertiajs/react';
import { Table as AntdTable } from 'antd';
import { useState } from 'react';



export default function Table({ actions, searUrl, ...props }) {
    const paginate = { pageSize: 50 }
    const [searchValue, setSearchValue] = useState()

    // HACK Сделать красивую кнопочку поиска

    function searchSubmit() {
        // router.post(route('glossary.banks.update'), { //DEV разработать страницу поиска на бэке
        //   search: searchValue
        // })
    }

    function serachOnChange(value) {
        setSearchValue(value)

        // DEV
        //sleep 3 seconds
        // if value changed
        // searchSubmit()
    }

    return (
        <div className="table-box">
            <div className="top-side-box">
                <div className="search-box">
                    <input type="search" name="search" id="search" onChange={serachOnChange} />
                    <button onClick={searchSubmit}>поиск</button>
                </div>
                <div className="actions-box">
                    {actions}
                </div>
            </div>
            <div className="table-content-box">
                <AntdTable {...props} pagination={paginate} />
            </div>
        </div>
    );
};
