import Header from '@/includes/Header'
import LoadIco from '@/includes/LoadIco'
import Flash from '@/includes/Flash'


export default function AuthenticatedLayout({ children }) {
    return (
        <div className="authenticated-layout">
            <LoadIco />
            <Flash />
            <Header />
            {children}
        </div>
    );
}
