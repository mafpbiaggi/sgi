import { Link, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { update, index } from '@/actions/App/Http/Controllers/VisitorController';
import { maskDate, maskPhone } from "@/lib/masks";

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
  referral_source_social_media: string;
  referral_source_other: string;
}

type Props = {
  readonly visitor: Visitor;
};

export default function Edit({ visitor }: Props) {
  const { data, setData, put, processing, errors } = useForm({
    visit_date: visitor.visit_date,
    name: visitor.name,
    age: visitor.age.toString(),
    phone: visitor.phone,
    email: visitor.email,
    attends_church: visitor.attends_church ?? '',
    prayer_request: visitor.prayer_request ?? '',
    referral_source: visitor.referral_source,
    referral_source_social_media: visitor.referral_source_social_media ?? '',
    referral_source_other: visitor.referral_source_other ?? '',
  });

  function submit(event: React.SubmitEvent<HTMLFormElement>) {
    event.preventDefault();
    put(update(visitor.id).url);
  }

  return (
    <div className="space-y-6 p-6">
      <h1 className="mb-6 text-2xl font-semibold">Editar visitante</h1>

      <form onSubmit={submit} className="space-y-4">
        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-2">
            <label htmlFor="visit_date" className="block text-sm font-medium">Data da visita</label>
            <input
              id="visit_date"
              name="visit_date"
              type="text"
              value={data.visit_date}
              onChange={(e) => setData('visit_date', maskDate(e.target.value))}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.visit_date} />
          </div>

          <div className="col-span-12 md:col-span-8">
            <label htmlFor="name" className="block text-sm font-medium">Nome</label>
            <input
              id="name"
              value={data.name}
              onChange={(e) => setData('name', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.name} />
          </div>

          <div className="col-span-12 md:col-span-2">
            <label htmlFor="age" className="block text-sm font-medium">Idade</label>
            <input
              id="age"
              type="number"
              value={data.age}
              onChange={(e) => setData('age', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.age} />
          </div>
        </div>

        <div className="grid grid-cols-2 gap-4">
          <div>
            <label htmlFor="phone" className="block text-sm font-medium">Telefone</label>
            <input
              id="phone"
              name="phone"
              value={data.phone}
              onChange={(e) => setData('phone', maskPhone(e.target.value))}
              placeholder='Somente números'
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.phone} />
          </div>

          <div>
            <label htmlFor="email" className="block text-sm font-medium">E-mail</label>
            <input
              id="email"
              type="email"
              value={data.email}
              onChange={(e) => setData('email', e.target.value)}
              autoComplete='email'
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.email} />
          </div>
        </div>

        <div className="grid grid-cols-2 gap-4">
          <div>
            <label htmlFor="attends_church" className="block text-sm font-medium">Frequenta igreja</label>
            <input
              id="attends_church"
              value={data.attends_church ?? ''}
              onChange={(e) => setData('attends_church', e.target.value)}
              placeholder='Sim, Igreja Assembléia de Deus'
              className="mt-1 w-full rounded-md border p-2"
            />
          </div>

          <div>
            <label htmlFor="prayer_request" className="block text-sm font-medium">Pedido de oração</label>
            <input
              id="prayer_request"
              value={data.prayer_request ?? ''}
              onChange={(e) => setData('prayer_request', e.target.value)}
              placeholder='Sim, pela família'
              className="mt-1 w-full rounded-md border p-2"
            />
          </div>
        </div>

        <div className="grid grid-cols-3 gap-4">
          <div>
            <label htmlFor="referral_source" className="block text-sm font-medium">Como nos conheceu</label>
            <select
              id="referral_source"
              value={data.referral_source}
              onChange={(e) => setData('referral_source', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Indicação</option>
              <option value="2">Convite</option>
              <option value="3">Moro perto</option>
              <option value="4">Redes sociais</option>
              <option value="5">Outro</option>
            </select>
            <InputError message={errors.referral_source} />
          </div>

          <div>
            <label htmlFor="referral_source_social_media" className="block text-sm font-medium">Redes sociais</label>
            <input
              id="referral_source_social_media"
              value={data.referral_source_social_media ?? ''}
              onChange={(e) => setData('referral_source_social_media', e.target.value)}
              placeholder='YouTube ou Instagram'
              disabled={data.referral_source !== '4'}
              className="mt-1 w-full rounded-md border p-2"
            />
          </div>

          <div>
            <label htmlFor="referral_source_other" className="block text-sm font-medium">Outro</label>
            <input
              id="referral_source_other"
              value={data.referral_source_other ?? ''}
              onChange={(e) => setData('referral_source_other', e.target.value)}
              disabled={data.referral_source !== '5'}
              className="mt-1 w-full rounded-md border p-2"
            />
          </div>
        </div>

        <div className="flex gap-3">
          <button
            type="submit"
            disabled={processing}
            className="rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground disabled:opacity-50"
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
