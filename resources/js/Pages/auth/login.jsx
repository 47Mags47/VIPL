import GuestLayout from '@/Layouts/GuestLayout';
import VerticalForm from '@/components/form/VerticalForm';
import Input from "@/components/inputs/Input"
import { router } from '@inertiajs/react';

export default function Login() {

    function onSubmit(data) {
        router.post(route('session.store'), data, {
            onSuccess: function (response) {

            //    if(response.status === 200){
            //     location.assign(response.data.redirect)
            //    }
            }
        })
    }

    return (
        <GuestLayout>
            <VerticalForm
                header="Войти в систему"
                onSubmit={onSubmit}
                method="POST"
                sbm="Войти"
            >
                <Input type="email" name="email" label="Email" />
                <Input type="password" name="password" label="Пароль" />
            </VerticalForm>
        </GuestLayout>
    )
}
