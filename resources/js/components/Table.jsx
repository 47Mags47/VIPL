import { Table as AntdTable } from 'antd';


export default function Table({ columns, data, action }) {

  const paginate = { pageSize: 50 }

  // actions == actions ?? ''
  
  // HACK Сделать красивую кнопочку поиска
  return (
    <div className="table-box">
      <div className="top-side-box">
        <div className="search-box">
          <input type="search" name="" id="" />
          <button>поиск</button>
        </div>
        <div className="actions-box">
          {/* {ations} */}
        </div>
      </div>
      <div className="table-content-box">
        <AntdTable columns={columns} dataSource={data} pagination={paginate} search />
      </div>
    </div>
  );
};