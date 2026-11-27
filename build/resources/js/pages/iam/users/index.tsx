import { Link, router } from '@inertiajs/react';
import { create, edit, destroy } from '@/actions/App/Http/Controllers/Iam/UserController';
import { ArrowLeft, ArrowRight, Trash } from 'lucide-react';

type Role = {
    id: number;
    name: string;
};

type User = {
    id: number;
    name: string;
    email: string;
    roles: Role[];
};

type PaginationLink = {
    url: string | null;
    label: string;
    active: boolean;
};

type Props = {
    readonly users: {
        data: User[];
        current_page: number;
        last_page: number;
        links: PaginationLink[];
    };
};

function handleDelete(id: number) {
    if (confirm('Deseja realmente excluir este usuário?')) {
        router.delete(destroy(id).url);
    }
}

function handleEdit(id: number) {
    return router.visit(edit(id).url);
}

export default function Index({ users }: Props) {
    return (
        <div className="space-y-6 p-6">
            <div className="flex items-center justify-between">
                <h1 className="text-2xl font-semibold">Usuários</h1>

                <Link
                    href={create().url}
                    className="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground"
                >
                    Novo usuário
                </Link>
            </div>

            <div className="overflow-hidden rounded-lg border">
                <table className="min-w-full text-sm">
                    <thead className="bg-muted">
                        <tr>
                            <th className="p-4 text-left">ID</th>
                            <th className="p-4 text-left">Nome</th>
                            <th className="p-4 text-left">E-mail</th>
                            <th className="p-4 text-left">Grupos</th>
                            <th className="p-4 text-right"></th>
                        </tr>
                    </thead>

                    <tbody>
                        {users.data.map((user) => (
                            <tr key={user.id} className="border-t">
                                <td onClick={() => handleEdit(user.id)} className="cursor-pointer p-5">{user.id}</td>
                                <td onClick={() => handleEdit(user.id)} className="cursor-pointer p-5">{user.name}</td>
                                <td onClick={() => handleEdit(user.id)} className="cursor-pointer p-5">{user.email}</td>
                                <td onClick={() => handleEdit(user.id)} className="cursor-pointer p-5">
                                    <div className="flex flex-wrap gap-1">
                                        {user.roles.length > 0
                                            ? user.roles.map((role) => (
                                                <span
                                                    key={role.id}
                                                    className="rounded-full bg-muted px-2 py-0.5 text-xs font-medium"
                                                >
                                                    {role.name}
                                                </span>
                                            ))
                                            : <span className="text-muted-foreground">—</span>
                                        }
                                    </div>
                                </td>
                                <td className="space-x-3 p-5 text-right">
                                    <button
                                        type="button"
                                        onClick={() => handleDelete(user.id)}
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
                    {users.current_page > 1 && (
                        <Link
                            href={users.links[0].url ?? '#'}
                            preserveScroll
                            className="rounded-md border px-3 py-1.5 text-sm"
                        >
                            <ArrowLeft className="h-4 w-4" />
                        </Link>
                    )}

                    <span className="text-sm">
                        {users.current_page} de {users.last_page}
                    </span>

                    {users.current_page < users.last_page && (
                        <Link
                            href={users.links.at(-1)?.url ?? '#'}
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
