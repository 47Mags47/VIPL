import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input, Select } from '@/components/forms';


export default function Edit() {
    const { data, setData, post, processing } = useForm({
        name: '',
        email: '',
        division_id: '',
        roles: [],
    });

    function onSubmit(e) {
        e.preventDefault()

        post(route('main.users.store'), data)
    }

    return (
        <Layout>
            <Form
                header='Создание пользователя'
                handleSubmit={onSubmit}
                sbm="Сохранить"
                processing={processing}
            >
                <Input
                    name="name"
                    label="ФИО"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                />
                <Input
                    name="email"
                    label="Email"
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                />
                <Select
                    name="division_id"
                    label="Подразделение"
                    list={usePage().props.divisions.data}
                    item_value="name"
                    value={data.division_id}
                    onChange={(value) => setData('division_id', value)}
                />
                <Select
                    name="roles"
                    label="Роль"
                    list={usePage().props.roles.data}
                    item_key="code"
                    item_value="name"
                    value={data.roles}
                    onChange={(value) => setData('roles', value)}
                    tags
                />
            </Form>
        </Layout>
    );
}
