import { useForm, usePage } from '@inertiajs/react'

import { AuthenticatedLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input, Select } from '@/components/forms';
import BlueButton from '@/components/buttons/BlueButton';
import { router } from '@inertiajs/react';


export default function Edit() {
    const user = usePage().props.user.data
    const { data, setData, put, processing } = useForm({
        name: user.name,
        email: user.email,
        division_id: user.division.id,
        roles: user.roles.map((role) => role.code),
    });

    function onSubmit(e) {
        e.preventDefault()

        put(route('main.users.update', { user: user.id }), data)
    }

    function sendIvation() {
        router.post(route('main.users.invition.send', { user: user.id }))
    }

    const info = () => {
        if (user.status.code !== 'active')
            return (
                <BlueButton onClick={sendIvation}>Отправить приглашение</BlueButton>
            )
    }


    return (
        <Layout>
            <Form
                header='Редактирование пользователя'
                handleSubmit={onSubmit}
                sbm="сохранить"
                processing={processing}
                info={info()}
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
                    multiple
                />
            </Form>
        </Layout>
    );
}
