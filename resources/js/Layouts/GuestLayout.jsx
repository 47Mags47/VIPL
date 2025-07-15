// DELETE Компонент является устаревшим и будет удален, замена на '@/components/lauouts/GuestLayout'

export default function GuestLayout({ children }) {
    return (
        <div className="layout guest-layout">
            {children}
        </div>
    );
}
