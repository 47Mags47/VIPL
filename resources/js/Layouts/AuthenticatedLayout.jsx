import Header from '@/includes/Header'
import LoadIco from '@/includes/LoadIco'


export default function AuthenticatedLayout({ children }) {
    return (
        <div className="authenticated-layout">
            <LoadIco />
            <Header />
            {children}
        </div>
    );
}
