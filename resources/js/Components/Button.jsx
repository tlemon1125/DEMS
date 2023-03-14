export default function Button({
    disabled,
    children,
    className = "",
    ...props
}) {
    const buttonColor = {
        grey: `bg-gray-800 text-white active:bg-gray-900 hover:bg-gray-700 focus:bg-gray-700 focus:ring-indigo-500 `,
    };

    return (
        <button
            className={
                `inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 ${
                    disabled && "opacity-25"
                } ` +
                buttonColor.grey +
                className
            }
        >
            {children}
        </button>
    );
}
