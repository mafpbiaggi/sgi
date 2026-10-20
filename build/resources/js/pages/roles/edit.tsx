import { Link, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { update, index } from '@/actions/App/Http/Controllers/RoleController';

type Permission = {
    id: number;
    name: string;
};

type Role = {
    id: number;
    name: string;
    permissions: Permission[];
};

type Props = {
    readonly role: Role;
    readonly permissions: Permission[];
};

export default function Edit({ role, permissions }: Props) {
    const { data, setData, put, processing, errors } = useForm({
        name: role.name,
        permissions: role.permissions.map((p) => p.name),
    });

    function submit(event: React.SubmitEvent<HTMLFormElement>) {
        event.preventDefault();
        put(update(role.id).url);
    }

    function togglePermission(name: string) {
        setData('permissions', data.permissions.includes(name)
            ? data.permissions.filter((p) => p !== name)
            : [...data.permissions, name],
        );
    }

    return (
        <div className="space-y-6 p-6">
            <h1 className="mb-6 text-2xl font-semibold">Editar grupo</h1>

            <form onSubmit={submit} className="space-y-6">
                <div>
                    <label htmlFor="name" className="block text-sm font-medium">
                        Nome
                    </label>
                    <input
                        id="name"
                        type="text"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        className="mt-1 w-full rounded-md border p-2"
                    />
                    <InputError message={errors.name} />
                </div>

                <div>
                    <p className="mb-3 text-sm font-medium">Permissões</p>
                    <div className="grid grid-cols-3 gap-2">
                        {permissions.map((permission) => (
                            <label
                                key={permission.id}
                                className="flex cursor-pointer items-center gap-2 rounded-md border p-3 text-sm"
                            >
                                <input
                                    type="checkbox"
                                    checked={data.permissions.includes(permission.name)}
                                    onChange={() => togglePermission(permission.name)}
                                />
                                {permission.name}
                            </label>
                        ))}
                    </div>
                    <InputError message={errors.permissions} />
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
