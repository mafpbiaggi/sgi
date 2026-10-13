import { Link, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { update, index } from '@/actions/App/Http/Controllers/PermissionController';

type Permission = {
    id: number;
    name: string;
};

type Props = {
    readonly permission: Permission;
};

export default function Edit({ permission }: Props) {
    const { data, setData, put, processing, errors } = useForm({
        name: permission.name,
    });

    function submit(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        put(update(permission.id).url);
    }

    return (
        <div className="px-20 py-10">
            <h1 className="mb-6 text-2xl font-semibold">Editar permissão</h1>

            <form onSubmit={submit} className="space-y-4">
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
