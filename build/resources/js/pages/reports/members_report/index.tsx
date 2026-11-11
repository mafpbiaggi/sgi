import { generate } from '@/actions/App/Http/Controllers/Reports/MemberReportController';

type SelectOption = {
    value: string; label: string
};

type Props = {
    readonly csrfToken: string;
    readonly options: {
        membership_status_options: SelectOption[];
        membership_type_options: SelectOption[];
        gender_options: SelectOption[];
        marital_status_options: SelectOption[];
        educational_level_options: SelectOption[];
        is_under_discipline_options: SelectOption[];
        is_baptized_options: SelectOption[];
        has_professed_faith_options: SelectOption[];
        birth_month_options: SelectOption[];
    };
};

function Field({ name, label, options }: Readonly<{ name: string; label: string; options: SelectOption[] }>) {
    return (
        <div>
            <label htmlFor={name} className="block text-sm font-medium">{label}</label>
            <select
                id={name}
                name={name}
                defaultValue=""
                className="mt-1 w-full rounded-md border p-2"
            >
                <option value="">Todos</option>
                {options.map((opt) => (
                    <option key={opt.value} value={opt.value}>{opt.label}</option>
                ))}
            </select>
        </div>
    );
}

export default function Create({ options, csrfToken }: Props) {
    return (
        <div className="space-y-6 p-6">
            <h1 className="mb-6 text-2xl font-semibold">Relatório de Membros</h1>

            <form
                method="POST"
                action={generate().url}
                target="_blank"
                className="space-y-4"
            >
                <input type="hidden" name="_token" value={csrfToken} />

                <div className="grid grid-cols-4 gap-4">
                    <Field name="membership_type" label="Tipo" options={options.membership_type_options} />
                    <Field name="membership_status" label="Situação" options={options.membership_status_options} />
                    <Field name="gender" label="Gênero" options={options.gender_options} />
                    <Field name="marital_status" label="Estado Civil" options={options.marital_status_options} />
                </div>

                <div className="grid grid-cols-4 gap-4">
                    <Field name="educational_level" label="Escolaridade" options={options.educational_level_options} />
                    <Field name="is_under_discipline" label="Sob Disciplina" options={options.is_under_discipline_options} />
                    <Field name="is_baptized" label="Batizado" options={options.is_baptized_options} />
                    <Field name="has_professed_faith" label="Professou a Fé" options={options.has_professed_faith_options} />
                </div>

                <div className="grid grid-cols-4 gap-4">
                    <Field name="birth_month" label="Mês de Nascimento" options={options.birth_month_options} />
                </div>

                <div className="flex gap-4 py-3">
                    <button
                        type="submit"
                        className="cursor-pointer rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground"
                    >
                        Gerar
                    </button>
                </div>
            </form>
        </div>
    );
}
