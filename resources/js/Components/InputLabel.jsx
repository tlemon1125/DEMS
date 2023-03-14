export default function InputLabel({
    value,
    className = "",
    children,
    ...props
}) {
    return (
        <label {...props} className={`block` + className}>
            {value ? value : children}
        </label>
    );
}
