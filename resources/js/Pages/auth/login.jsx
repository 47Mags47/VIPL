import GuestLayout from '@/Layouts/GuestLayout';
import Header from '../../components/Header';
import AuthForm from '../../components/form/AuthForm';

export default function Login(){
    return (
    <GuestLayout>
        <Header />
        <AuthForm />
    </GuestLayout>
    )
}


