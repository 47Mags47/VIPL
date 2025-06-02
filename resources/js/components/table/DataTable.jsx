import { usePage } from '@inertiajs/react';


export default function DataTable() {
  const { banks } = usePage().props;
  const data = banks?.data || [];
  const dataSource = data.map((value) => ({
    ...value,
    key: value.id,
  }));
  return { dataSource };
}
