import { useForm, usePage } from '@inertiajs/react';

import { GuestLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input } from '@/components/forms';


export default function ResetPassword() {
    const email = usePage().props.email

    const { data, setData, post, processing } = useForm({
        email: email,
        password: '',
        new_password: '',
        new_password_confirmation: '',
    })

    function onSubmit(e) {
        e.preventDefault()

        post(route('password.change'), data)
    }

    return (
        <Layout>
            <Form
                header="Смена пароля"
                sbm="Отправить"
                handleSubmit={onSubmit}
            >
                <Input
                    type="password"
                    name="password"
                    label="Старый пароль"
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                />
                <Input
                    type="password"
                    name="new_password"
                    label="Новый пароль"
                    value={data.new_password}
                    onChange={(e) => setData('new_password', e.target.value)}
                />
                <Input
                    type="password"
                    name="new_password_confirmation"
                    label="Повторите пароль"
                    value={data.new_password_confirmation}
                    onChange={(e) => setData('new_password_confirmation', e.target.value)}
                />
            </Form>
        </Layout>
    )
}
