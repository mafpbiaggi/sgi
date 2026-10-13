import { Link, router } from '@inertiajs/react';
import { create, edit, destroy } from '@/actions/App/Http/Controllers/RoleController';

type Role = {
    id: number;
    name: string;
    permissions_count: number;
};

type Props = {
    readonly roles: {
        data: Role[];
        current_page: number;
        last_page: number;
    };
};

function handleDelete(id: number) {
    if (confirm('Deseja realmente excluir este grupo?')) {
        router.delete(destroy(id).url);
    }
}

export default function Index({ roles }: Props) {
    return (
        <div className="space-y-6 p-6">
            <div className="flex items-center justify-between">
                <h1 className="text-2xl font-semibold">Grupos</h1>

                <Link
                    href={create().url}
                    className="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground"
                >
                    Novo grupo
                </Link>
            </div>

            <div className="overflow-hidden rounded-lg border">
                <table className="min-w-full text-sm">
                    <thead className="bg-muted">
                        <tr>
                            <th className="p-4 text-left">ID</th>
                            <th className="p-4 text-left">Nome</th>
                            <th className="p-4 text-left">Permissões</th>
                            <th className="p-4 text-right"></th>
                        </tr>
                    </thead>

                    <tbody>
                        {roles.data.map((role) => (
                            <tr key={role.id} className="border-t">
                                <td className="p-5">{role.id}</td>
                                <td className="p-5">{role.name}</td>
                                <td className="p-5">{role.permissions_count}</td>
                                <td className="space-x-3 p-5 text-right">
                                    <Link
                                        href={edit(role.id).url}
                                        className="rounded-md border px-4 py-2 text-sm"
                                    >
                                        Editar
                                    </Link>
                                    <button
                                        type="button"
                                        onClick={() => handleDelete(role.id)}
                                        className="cursor-pointer rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground"
                                    >
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}
