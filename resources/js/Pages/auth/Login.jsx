import { useForm } from '@inertiajs/react';

import { GuestLayout as Layout } from '@/layouts';
import { VerticalForm as Form, StringInput as Input } from '@/components/forms';


export default function Login() {
    const { data, setData, post, processing } = useForm({
        login: '',
        password: '',
    })

    function onSubmit(e) {
        e.preventDefault()

        post(route('login.post'), data, {
            onFinish: () => {
                console.log(1);

                setData({ ...data, password: '' })
            }
        })
    }

    return (
        <Layout>
            <Form
                header="Вход"
                sbm="Войти"
                handleSubmit={onSubmit}
            >
                <Input
                    name="login"
                    label="Логин или Email"
                    value={data.email}
                    onChange={(e) => setData('login', e.target.value)}
                />
                <Input
                    type="password"
                    name="password"
                    label="Пароль"
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                />
            </Form>
        </Layout>
    )
}
