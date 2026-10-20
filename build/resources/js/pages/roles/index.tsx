import { Link, router } from '@inertiajs/react';
import { create, edit, destroy } from '@/actions/App/Http/Controllers/RoleController';
import { ArrowLeft, ArrowRight, Trash } from 'lucide-react';

type Role = {
    id: number;
    name: string;
    permissions_count: number;
};

type PaginationLink = {
    url: string | null;
    label: string;
    active: boolean;
};

type Props = {
    readonly roles: {
        data: Role[];
        current_page: number;
        last_page: number;
        links: PaginationLink[];
    };
};

function handleDelete(id: number) {
    if (confirm('Deseja realmente excluir este grupo?')) {
        router.delete(destroy(id).url);
    }
}

function handleEdit(id: number) {
    return router.visit(edit(id).url);
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
                                <td onClick={() => handleEdit(role.id)} className="cursor-pointer p-5">{role.id}</td>
                                <td onClick={() => handleEdit(role.id)} className="cursor-pointer p-5">{role.name}</td>
                                <td onClick={() => handleEdit(role.id)} className="cursor-pointer p-5">{role.permissions_count}</td>
                                <td className="space-x-3 p-5 text-right">
                                    <button
                                        type="button"
                                        onClick={() => handleDelete(role.id)}
                                        className="cursor-pointer rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground"
                                    >
                                        <Trash className="h-4 w-4" />
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
            <div className="text-center">
                <div className="inline-flex items-center gap-3">
                    {roles.current_page > 1 && (
                        <Link
                            href={roles.links[0].url ?? '#'}
                            preserveScroll
                            className="rounded-md border px-3 py-1.5 text-sm"
                        >
                            <ArrowLeft className="h-4 w-4" />
                        </Link>
                    )}

                    <span className="text-sm">
                        {roles.current_page} de {roles.last_page}
                    </span>

                    {roles.current_page < roles.last_page && (
                        <Link
                            href={roles.links.at(-1)?.url ?? '#'}
                            preserveScroll
                            className="rounded-md border px-3 py-1.5 text-sm"
                        >
                            <ArrowRight className="h-4 w-4" />
                        </Link>
                    )}
                </div>
            </div>
        </div>
    );
}
