import BaseLayout from './BaseLayout'

import Header from '@/includes/Header'


export default function AuthenticatedLayout({ children }) {
    return (
        <BaseLayout name="authenticated-layout">
            <Header />
            <main>
                {children}
            </main>
        </BaseLayout>
    );
}
