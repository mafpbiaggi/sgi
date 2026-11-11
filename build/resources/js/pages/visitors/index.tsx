import { Link, router } from '@inertiajs/react';
import { create, edit, destroy } from '@/actions/App/Http/Controllers/VisitorController';
import { ArrowLeft, ArrowRight, Trash } from 'lucide-react';


type Visitor = {
    id: number;
    name: string;
    age: number;
    phone: string;
    email: string;
    visit_date: string;
    attends_church: string;
    prayer_request: string;
    referral_source: string;
    referral_source_label: string | null;
}

type PaginationLink = {
    url: string | null;
    label: string;
    active: boolean;
};

type Props = {
    readonly visitors: {
        data: Visitor[];
        current_page: number;
        last_page: number;
        links: PaginationLink[];
    }
};

function handleDelete(id: number) {
    if (confirm('Deseja realmente excluir este visitante?')) {
        return router.delete(destroy(id).url);
    }
}

function handleEdit(id: number) {
    return router.visit(edit(id).url);
}

export default function Index({ visitors }: Props) {
    return (
        <div className="space-y-6 p-6">
            <div className="flex items-center justify-between">
                <h1 className="text-2xl font-semibold">Visitantes</h1>

                <Link
                    href={create().url}
                    className="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground"
                >
                    Novo visitante
                </Link>
            </div>

            <div className="overflow-hidden rounded-lg border">
                <table className="min-w-full text-sm">
                    <thead className="bg-muted">
                        <tr>
                            <th className="p-3 text-left">Data da Visita</th>
                            <th className="p-3 text-left">Nome</th>
                            <th className="p-3 text-left">Idade</th>
                            <th className="p-3 text-left">Telefone</th>
                            <th className="p-3 text-left">E-mail</th>
                            <th className="p-3 text-left">Origem</th>
                            <th className="p-3 text-right"></th>
                        </tr>
                    </thead>

                    <tbody>
                        {visitors.data.map((visitor) => (
                            <tr key={visitor.id} className="border-t">
                                <td onClick={() => handleEdit(visitor.id)} className="cursor-pointer p-3">{visitor.visit_date}</td>
                                <td onClick={() => handleEdit(visitor.id)} className="cursor-pointer p-3">{visitor.name}</td>
                                <td onClick={() => handleEdit(visitor.id)} className="cursor-pointer p-3">{visitor.age}</td>
                                <td onClick={() => handleEdit(visitor.id)} className="cursor-pointer p-3">{visitor.phone}</td>
                                <td onClick={() => handleEdit(visitor.id)} className="cursor-pointer p-3">{visitor.email}</td>
                                <td onClick={() => handleEdit(visitor.id)} className="cursor-pointer p-3">{visitor.referral_source_label}</td>
                                <td className="space-x-3 p-3 text-right">
                                    <button
                                        type="button"
                                        onClick={() => handleDelete(visitor.id)}
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
                    {visitors.current_page > 1 && (
                        <Link
                            href={visitors.links[0].url ?? '#'}
                            preserveScroll
                            className="rounded-md border px-3 py-1.5 text-sm"
                        >
                            <ArrowLeft className="h-4 w-4" />
                        </Link>
                    )}

                    <span className="text-sm">
                        {visitors.current_page} de {visitors.last_page}
                    </span>

                    {visitors.current_page < visitors.last_page && (
                        <Link
                            href={visitors.links.at(-1)?.url ?? '#'}
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
