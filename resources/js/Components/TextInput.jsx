import { useEffect, useRef } from "react";

export default function TextInput({
    type = "text",
    className = "",
    isFocused = false,
    ...props
}) {
    const input = useRef();

    useEffect(() => {
        isFocused && input.current.focus();
    }, []);

    return (
        <div className="flex flex-col">
            <input
                {...props}
                type={type}
                className={
                    "rounded-md focus:border-red-900 focus:ring-red-900 mt-2" +
                    className
                }
                ref={input}
            />
        </div>
    );
}
