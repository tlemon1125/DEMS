export default function ErrorBox({ errors, className = "", ...props }) {
    return (
        <div
            className={
                "mt-1 mb-3 rounded-md border-red-800 bg-red-300 white text-red-900 flex flex-col items-center p-3 text-sm" +
                className
            }
            {...props}
        >
            {Object.keys(errors).map((error, i) => (
                <li key={i}>{errors[error]}</li>
            ))}
        </div>
    );
}
