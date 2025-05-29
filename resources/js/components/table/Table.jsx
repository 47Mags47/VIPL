import React, { useState } from 'react';
import { Button, Flex, Table } from 'antd';

const columns = [
  { title: '№', dataIndex: 'number' },
  { title: 'Название банка', dataIndex: 'bankName' },
  { title: 'Код банка', dataIndex: 'code' },
];

const TableComponent = ({dataSource}) => {
  const [selectedRowKeys, setSelectedRowKeys] = useState([]);
  const [loading, setLoading] = useState(false);
  const start = () => {
    setLoading(true);
    // ajax request after empty completing
    setTimeout(() => {
      setSelectedRowKeys([]); 
      setLoading(false);
    }, 1000);
  };
  const onSelectChange = newSelectedRowKeys => {
    console.log('selectedRowKeys changed: ', newSelectedRowKeys);
    setSelectedRowKeys(newSelectedRowKeys);
  };
  const rowSelection = {
    selectedRowKeys,
    onChange: onSelectChange,
  };
  const hasSelected = selectedRowKeys.length > 0;
  return (
    <Flex gap="middle" vertical>
      <Flex align="center" gap="middle">
        <Button type="primary" onClick={start} disabled={!hasSelected} loading={loading}>
          Reload
        </Button>
        {hasSelected ? `Selected ${selectedRowKeys.length} items` : null}
      </Flex>
      <Table rowSelection={rowSelection} columns={columns} dataSource={dataSource} />
    </Flex>
  );
};
export default TableComponent;