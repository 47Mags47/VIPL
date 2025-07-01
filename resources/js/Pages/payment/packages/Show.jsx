import GoToIco from '@/components/icons/GoToIco'


export default function Show({ record }) {
    const href = route('payments.packages.show', { event: record.event.id, package: record.id });

    return (
        <GoToIco href={href} />
    )
}
