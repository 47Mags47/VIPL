import { useForm, usePage } from '@inertiajs/react';

import { GuestLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input } from '@/components/forms';


export default function ResetPassword() {
    const email = usePage().props.email

    const { data, setData, post, processing } = useForm({
        email: email,
        old_password: '',
        password: '',
        password_confirmation: '',
    })

    function onSubmit(e) {
        e.preventDefault()

        post(route('password.change'), data)
    }

    return (
        <Layout>
            <Form
                header="Восстановление пароля"
                sbm="Отправить"
                handleSubmit={onSubmit}
            >
                <Input
                    type="password"
                    name="old_password"
                    label="Старый пароль"
                    value={data.old_password}
                    onChange={(e) => setData('old_password', e.target.value)}
                />
                <Input
                    type="password"
                    name="password"
                    label="Новый пароль"
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                />
                <Input
                    type="password"
                    name="password_confirmation"
                    label="Повторите пароль"
                    value={data.password_confirmation}
                    onChange={(e) => setData('password_confirmation', e.target.value)}
                />
            </Form>
        </Layout>
    )
}
