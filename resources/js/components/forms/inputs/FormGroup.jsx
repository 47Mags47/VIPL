import Error from "@/components/Error"

export default function FormGroup({ ...props }) {
    name = props.name ?? ''

    return (
        <div className={"form-group " + name}>
            {props.children}
            <Error name={name} />
        </div>
    )

}
