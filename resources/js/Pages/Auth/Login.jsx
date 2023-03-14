import InputLabel from "../../Components/InputLabel";
import TextInput from "../../Components/TextInput";
import AuthLayout from "../../Layouts/AuthLayout";
import ErrorBox from "../../Components/ErrorBox";
import Button from "../../Components/Button";
import { Head, Link, useForm, usePage } from "@inertiajs/react";

export default function Login() {
    const { data, setData, processing, post } = useForm({
        email: "",
        password: "",
        remember: "",
    });

    const { errors } = usePage().props;

    const handleChange = (event) => {
        setData(
            event.target.name,
            event.target.type === "checkbox"
                ? event.target.checked
                : event.target.value
        );
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        post(route("login"));
    };

    return (
        <AuthLayout>
            <Head title="Login" />
            <div className="w-full p-3">
                <h1 className="flex text-3xl mb-2 justify-center"> Login </h1>
            </div>
            <form onSubmit={handleSubmit}>
                <input type="hidden" name="remember" defaultValue="true" />
                {Object.keys(errors).length != 0 && (
                    <ErrorBox errors={errors} />
                )}
                <div>
                    <InputLabel htmlFor="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        onChange={handleChange}
                        isFocused={true}
                        required
                    />
                </div>
                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div className="mt-4">
                    <Link
                        href={route("password.request")}
                        className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Forgot Your Password?
                    </Link>
                </div>
                <div className="mt-5">
                    <Button
                        className="w-full h-10 flex justify-center"
                        disabled={processing}
                    >
                        Login
                    </Button>
                </div>
            </form>
        </AuthLayout>
    );
}
