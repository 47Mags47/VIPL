import GoToIco from '@/components/icons/GoToIco'


export default function Show({ packages, record }) {
    const href = route('payments.files.show', { package:packages.id, file: record.id })
    return (
        <GoToIco href={href} />
    )
}
