import { Link, router } from '@inertiajs/react';
import { create, edit, destroy } from '@/actions/App/Http/Controllers/UserController';

type User = {
    id: number;
    name: string;
    email: string;
};

type Props = {
    readonly users: {
        data: User[];
        current_page: number;
        last_page: number;
    };
};

function handleDelete(id: number) {
    if (confirm('Deseja realmente excluir este usuário?')) {
        router.delete(destroy(id).url);
    }
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
                            <th className="p-4 text-right"></th>
                        </tr>
                    </thead>

                    <tbody>
                        {users.data.map((user) => (
                            <tr key={user.id} className="border-t">
                                <td className="p-5">{user.id}</td>
                                <td className="p-5">{user.name}</td>
                                <td className="p-5">{user.email}</td>
                                <td className="space-x-3 p-5 text-right">
                                    <Link
                                        href={edit(user.id).url}
                                        className="rounded-md border px-4 py-2 text-sm"
                                    >
                                        Editar
                                    </Link>
                                    <button
                                        type="button"
                                        onClick={() => handleDelete(user.id)}
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
