import { Link, router } from '@inertiajs/react';
import { create, edit, destroy } from '@/actions/App/Http/Controllers/MemberController';
import { ArrowLeft, ArrowRight, Trash } from 'lucide-react';
import { useState } from 'react';

type Tab = 'active' | 'separated' | 'dismissed';

type MemberAdmission = {
    admission_order: string;
    admission_date: string;
}

type Member = {
    id: number;
    name: string;
    mobile_phone: string;
    email: string;
    current_admission: MemberAdmission;
}

type PaginationLink = {
    url: string | null;
    label: string;
    active: boolean;
};

type Props = {
    readonly members_active: {
        data: Member[];
        current_page: number;
        last_page: number;
        links: PaginationLink[];
    }

    readonly members_separated: {
        data: Member[];
        current_page: number;
        last_page: number;
        links: PaginationLink[];
    }

    readonly members_dismissed: {
        data: Member[];
        current_page: number;
        last_page: number;
        links: PaginationLink[];
    }
    readonly total_active: string;
    readonly total_separated: string;
    readonly total_dismissed: string;
};

function handleDelete(id: number) {
    if (confirm('Deseja realmente excluir este membro?')) {
        return router.delete(destroy(id).url);
    }
}

function handleEdit(id: number) {
    return router.visit(edit(id).url);
}

const tabs: { id: Tab; label: string;}[] = [
    { id: 'active', label: 'Ativos'},
    { id: 'separated', label: 'Rol separado' },
    { id: 'dismissed', label: 'Demitidos'},
];

export default function Index({ members_active, members_separated, members_dismissed, total_active, total_separated, total_dismissed }: Props) {
    const [activeTab, setActiveTab] = useState<Tab>('active');

    return (
        <div className="space-y-6 p-6">
            <div className="flex items-center justify-between">
                <h1 className="text-2xl font-semibold">Membros</h1>
                <Link
                    href={create().url}
                    className="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground"
                >
                    Novo membro
                </Link>
            </div>

            <div role="tablist" className="flex gap-2 border-b">
                {tabs.map((tab) => (
                    <button
                        key={tab.id}
                        type="button"
                        role="tab"
                        id={`tab-${tab.id}`}
                        aria-selected={activeTab === tab.id}
                        aria-controls={`panel-${tab.id}`}
                        onClick={() => setActiveTab(tab.id)}
                        className={`-mb-px border-b-2 px-4 py-2 text-sm font-medium ${activeTab === tab.id
                            ? 'border-primary text-primary'
                            : 'border-transparent text-muted-foreground hover:text-foreground'
                            }`}
                    >
                        {tab.label}
                    </button>
                ))}
            </div>

            <div role="tabpanel" id="panel-active" aria-labelledby="tab-active" className={activeTab === 'active' ? '' : 'hidden'}>
                <h1 className="text-right">Total de membros ativos: {total_active}</h1>

                <div className="my-4 overflow-hidden rounded-lg border">
                    <table className="min-w-full text-sm">
                        <thead className="bg-muted">
                            <tr>
                                <th className="p-3 text-left">Ordem de Admissão</th>
                                <th className="p-3 text-left">Data de Admissão</th>
                                <th className="p-3 text-left">Nome</th>
                                <th className="p-3 text-left">Celular</th>
                                <th className="p-3 text-left">E-mail</th>
                                <th className="p-3 text-right"></th>
                            </tr>
                        </thead>

                        <tbody>
                            {members_active.data.map((member) => (
                                <tr key={member.id} className="border-t">
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.current_admission.admission_order}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.current_admission.admission_date}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.name}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.mobile_phone}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.email}</td>
                                    <td className="space-x-3 p-3 text-right">
                                        <button
                                            type="button"
                                            onClick={() => handleDelete(member.id)}
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
                        {members_active.current_page > 1 && (
                            <Link
                                href={members_active.links[0].url ?? '#'}
                                preserveScroll
                                className="rounded-md border px-3 py-1.5 text-sm"
                            >
                                <ArrowLeft className="h-4 w-4" />
                            </Link>
                        )}

                        <span className="text-sm">
                            {members_active.current_page} de {members_active.last_page}
                        </span>

                        {members_active.current_page < members_active.last_page && (
                            <Link
                                href={members_active.links.at(-1)?.url ?? '#'}
                                preserveScroll
                                className="rounded-md border px-3 py-1.5 text-sm"
                            >
                                <ArrowRight className="h-4 w-4" />
                            </Link>
                        )}
                    </div>
                </div>
            </div>

            <div role="tabpanel" id="panel-separated" aria-labelledby="tab-separated" className={activeTab === 'separated' ? '' : 'hidden'}>
                <h1 className="text-right">Total de membros em rol separado: {total_separated}</h1>

                <div className="my-4 overflow-hidden rounded-lg border">
                    <table className="min-w-full text-sm">
                        <thead className="bg-muted">
                            <tr>
                                <th className="p-3 text-left">Ordem de Admissão</th>
                                <th className="p-3 text-left">Data de Admissão</th>
                                <th className="p-3 text-left">Nome</th>
                                <th className="p-3 text-left">Celular</th>
                                <th className="p-3 text-left">E-mail</th>
                                <th className="p-3 text-right"></th>
                            </tr>
                        </thead>

                        <tbody>
                            {members_separated.data.map((member) => (
                                <tr key={member.id} className="border-t">
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.current_admission.admission_order}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.current_admission.admission_date}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.name}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.mobile_phone}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.email}</td>
                                    <td className="space-x-3 p-3 text-right">
                                        <button
                                            type="button"
                                            onClick={() => handleDelete(member.id)}
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
                        {members_separated.current_page > 1 && (
                            <Link
                                href={members_separated.links[0].url ?? '#'}
                                preserveScroll
                                className="rounded-md border px-3 py-1.5 text-sm"
                            >
                                <ArrowLeft className="h-4 w-4" />
                            </Link>
                        )}

                        <span className="text-sm">
                            {members_separated.current_page} de {members_separated.last_page}
                        </span>

                        {members_separated.current_page < members_separated.last_page && (
                            <Link
                                href={members_separated.links.at(-1)?.url ?? '#'}
                                preserveScroll
                                className="rounded-md border px-3 py-1.5 text-sm"
                            >
                                <ArrowRight className="h-4 w-4" />
                            </Link>
                        )}
                    </div>
                </div>
            </div>

            <div role="tabpanel" id="panel-dismissed" aria-labelledby="tab-dismissed" className={activeTab === 'dismissed' ? '' : 'hidden'}>
                <h1 className="text-right">Total de membros demitidos: {total_dismissed}</h1>

                <div className="my-4 overflow-hidden rounded-lg border">
                    <table className="min-w-full text-sm">
                        <thead className="bg-muted">
                            <tr>
                                <th className="p-3 text-left">Ordem de Admissão</th>
                                <th className="p-3 text-left">Data de Admissão</th>
                                <th className="p-3 text-left">Nome</th>
                                <th className="p-3 text-left">Celular</th>
                                <th className="p-3 text-left">E-mail</th>
                                <th className="p-3 text-right"></th>
                            </tr>
                        </thead>

                        <tbody>
                            {members_dismissed.data.map((member) => (
                                <tr key={member.id} className="border-t">
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3 ">{member.current_admission.admission_order}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.current_admission.admission_date}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.name}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.mobile_phone}</td>
                                    <td onClick={() => handleEdit(member.id)} className="cursor-pointer p-3">{member.email}</td>
                                    <td className="space-x-3 p-3 text-right">
                                        <button
                                            type="button"
                                            onClick={() => handleDelete(member.id)}
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
                        {members_dismissed.current_page > 1 && (
                            <Link
                                href={members_dismissed.links[0].url ?? '#'}
                                preserveScroll
                                className="rounded-md border px-3 py-1.5 text-sm"
                            >
                                <ArrowLeft className="h-4 w-4" />
                            </Link>
                        )}

                        <span className="text-sm">
                            {members_dismissed.current_page} de {members_dismissed.last_page}
                        </span>

                        {members_dismissed.current_page < members_dismissed.last_page && (
                            <Link
                                href={members_dismissed.links.at(-1)?.url ?? '#'}
                                preserveScroll
                                className="rounded-md border px-3 py-1.5 text-sm"
                            >
                                <ArrowRight className="h-4 w-4" />
                            </Link>
                        )}
                    </div>
                </div>
            </div>

        </div>
    );
}
