import { useForm } from '@inertiajs/react';

import { GuestLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input } from '@/components/forms';


export default function ForgotPassword() {
    const { data, setData, post, processing } = useForm({
        email: '',
    })

    function onSubmit(e) {
        e.preventDefault()

        post(route('password.email'), data)
    }

    return (
        <Layout>
            <Form
                header="Восстановление пароля"
                sbm="Отправить"
                handleSubmit={onSubmit}
            >
                <Input
                    name="email"
                    label="Email"
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                />

            </Form>
        </Layout>
    )
}
