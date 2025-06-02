import Header from '@/includes/Header'
export default function AuthenticatedLayout({ children }) {
    return ( 
        <div className="authenticated-layout">
            <Header />
            {children}
        </div>
    );
}
