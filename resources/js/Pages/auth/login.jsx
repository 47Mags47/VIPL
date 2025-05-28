import GuestLayout from '@/Layouts/GuestLayout';
import Header from '../../components/Header';
import AuthForm from '../../components/AuthForm';

export default function Login(){
    return (
    <GuestLayout>
        <Header />
        <AuthForm />
    </GuestLayout>
    )
}


