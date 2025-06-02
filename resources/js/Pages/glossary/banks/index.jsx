import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Table from "@/components/Table";
import { usePage } from "@inertiajs/react";
import Edit from "./Edit";
import { router } from '@inertiajs/react'
import BaseButton from "@/components/button/BaseButton"


export default function index() {

  const data = usePage().props.banks.data.map(function (item, i) {
    item.key = item.id

    return item
  })

  const columns = [
    {
      title: 'Числовой код',
      dataIndex: 'number_code',
    },
    {
      title: 'Строковый код',
      dataIndex: 'code',
    },
    {
      title: 'Наименование',
      dataIndex: 'name',
    },

    {
      title: 'Экспортер',
      dataIndex: ['exporter', 'name'],
    },

    {
      title: 'Номер контракта',
      dataIndex: ['contract', 'number'],
    },
    {
      title: 'Дата заключения',
      dataIndex: ['contract', 'signed_at'],
    },

    {
      title: 'Сторона организации',
      dataIndex: ['contract', 'division_side', 'name'],
    },
    {
      title: 'Наименование',
      dataIndex: ['contract', 'division_side', 'name'],
    },
        {
      title: 'ИНН',
      dataIndex: ['contract', 'division_side', 'INN'],
    },
        {
      title: 'Счет',
      dataIndex: ['contract','division_side', 'account'],
    },
    {
      title: 'БИК',
      dataIndex: ['contract', 'division_side', 'BIK'],
    },
        {
      title: 'Комментарий',
      dataIndex: ['contract', 'division_side', 'comment'],
    },

    {
      title: '',
      key: 'delete',
      render: (_, record) => (
        <BaseButton type="button" onClick={() => onDelete(record)}>
          Delete
        </BaseButton>
      )
    },
    {
      title: '',
      key: 'edit',
      render: (_, record) => (
        <Edit record={record} />
      )
    },
  ];
    function onDelete(record) {
      // console.log();
        if (confirm("Вы уверены, что хотите удалить эту запись?")) {
            router.delete(route('glossary.banks.delete', { bank: record.id }),{
                onSuccess: function (response) {
                    console.log("123");

                },
                onError: function (error) {

                },
            });
        }
    }
  return (
    <AuthenticatedLayout>
      <Table columns={columns} data={data} />
    </AuthenticatedLayout>
  );
}
