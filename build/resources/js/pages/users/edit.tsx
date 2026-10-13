import { Link, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import PasswordInput from '@/components/password-input';
import { update, index } from '@/actions/App/Http/Controllers/UserController';

type User = {
    id: number;
    name: string;
    email: string;
};

type Props = {
    readonly user: User;
};

export default function Edit({ user }: Props) {
    const { data, setData, put, processing, errors } = useForm({
        name: user.name,
        email: user.email,
        password: '',
    });

    function submit(event: React.SubmitEvent<HTMLFormElement>) {
        event.preventDefault();
        put(update(user.id).url);
    }

    return (
        <div className="px-20 py-10">
            <h1 className="mb-6 text-2xl font-semibold">Editar usuário</h1>

            <form onSubmit={submit} className="space-y-4">
                <div>
                    <label htmlFor="name" className="block text-sm font-medium">
                        Nome
                    </label>
                    <input
                        id="name"
                        type="text"
                        autoComplete="name"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        className="mt-1 w-full rounded-md border p-2"
                    />
                    <InputError message={errors.name} />
                </div>

                <div className="grid grid-cols-2 gap-4">
                    <div>
                        <label htmlFor="email" className="block text-sm font-medium">
                            E-mail
                        </label>
                        <input
                            id="email"
                            type="email"
                            autoComplete="email"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            className="mt-1 w-full rounded-md border p-2"
                        />
                        <InputError message={errors.email} />
                    </div>

                    <div>
                        <label htmlFor="password" className="block text-sm font-medium">
                            Nova senha
                        </label>
                        <PasswordInput
                            id="password"
                            name="password"
                            autoComplete="new-password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            placeholder='Deixe em branco para manter a mesma senha'
                            className="mt-1 p-5"
                        />
                        <InputError message={errors.password} />
                    </div>
                </div>

                <div className="flex gap-4 py-3">
                    <button
                        type="submit"
                        disabled={processing}
                        className="cursor-pointer rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground disabled:opacity-50"
                    >
                        {processing ? 'Salvando...' : 'Salvar'}
                    </button>

                    <Link
                        href={index().url}
                        className="rounded-md border px-4 py-2 text-sm"
                    >
                        Cancelar
                    </Link>
                </div>
            </form>
        </div>
    );
}
