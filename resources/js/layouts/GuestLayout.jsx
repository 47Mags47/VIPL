import BaseLayout from './BaseLayout'

export default function GuestLayout({ children }) {
    return (
        <BaseLayout name="guest-layout">
            {children}
        </BaseLayout>
    )
}
