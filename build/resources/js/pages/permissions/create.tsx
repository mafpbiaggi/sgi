import { Link, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { store, index } from '@/actions/App/Http/Controllers/PermissionController';

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
    });

    function submit(event: React.SubmitEvent<HTMLFormElement>) {
        event.preventDefault();
        post(store().url);
    }

    return (
        <div className="space-y-6 p-6">
            <h1 className="mb-6 text-2xl font-semibold">Nova permissão</h1>

            <form onSubmit={submit} className="space-y-4">
                <div>
                    <label htmlFor="name" className="block text-sm font-medium">
                        Nome
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        required
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        className="mt-1 w-full rounded-md border p-2"
                        placeholder="ex: users.create"
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
