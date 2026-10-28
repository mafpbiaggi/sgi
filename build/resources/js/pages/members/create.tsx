import { Link, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { store, index } from '@/actions/App/Http/Controllers/MemberController';
import { maskDate, maskPhone, maskRg, maskCpf } from "@/lib/masks";
import { usePostalCodeLookup } from '@/hooks/use-postal-code-lookup';


export default function Create() {
  const { data, setData, post, processing, errors } = useForm({
    admission: {
      membership_type: '',
      membership_status: '',
      admission_order: '',
      admission_date: '',
      admission_reason: '',
      admission_minute: '',
      dismissal_date: '',
      dismissal_reason: '',
      dismissal_minute: '',
    },
    name: '',
    gender: '',
    birth_date: '',
    birthplace: '',
    document_rg: '',
    document_cpf: '',
    marital_status: '',
    marriage_date: '',
    spouse_name: '',
    father_name: '',
    mother_name: '',
    email: '',
    phone: '',
    secondary_phone: '',
    mobile_phone: '',
    street: '',
    number: '',
    complement: '',
    neighborhood: '',
    postal_code: '',
    city: '',
    state: '',
    educational_level: '',
    occupation: '',
    is_under_discipline: '',
    is_baptized: '',
    baptism_date: '',
    baptism_church: '',
    baptism_pastor: '',
    has_professed_faith: '',
    profession_of_faith_date: '',
    profession_of_faith_church: '',
    profession_of_faith_pastor: '',
    last_church: '',
  });

  const {
    loading: postalCodeLoading,
    error: postalCodeError,
    numberRef,
    handlePostalCodeChange,
  } = usePostalCodeLookup((fields) => setData((prev) => ({ ...prev, ...fields })));

  function submit(event: React.SubmitEvent<HTMLFormElement>) {
    event.preventDefault();
    post(store().url);
  }

  return (
    <div className="space-y-6 p-6">
      <h1 className="mb-6 text-2xl font-semibold">Novo membro</h1>
      <form onSubmit={submit} className="space-y-4">
        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-3">
            <label htmlFor="membership_type" className="block text-sm font-medium">Tipo</label>
            <select
              id="membership_type"
              value={data.admission.membership_type}
              onChange={(e) => setData('admission.membership_type', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Ativo</option>
              <option value="2">Rol separado</option>
              <option value="3">Demitido</option>
            </select>
            <InputError message={errors['admission.membership_type']} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="membership_status" className="block text-sm font-medium">Situação</label>
            <select
              id="membership_status"
              value={data.admission.membership_status}
              onChange={(e) => setData('admission.membership_status', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Comungante</option>
              <option value="2">Não comungante</option>
            </select>
            <InputError message={errors['admission.membership_status']} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="is_under_discipline" className="block text-sm font-medium">Sob Disciplina</label>
            <select
              id="is_under_discipline"
              value={data.is_under_discipline}
              onChange={(e) => setData('is_under_discipline', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>
            <InputError message={errors.is_under_discipline} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="admission_order" className="block text-sm font-medium">Ordem de Admissão</label>
            <input
              id="admission_order"
              name="admission_order"
              value={data.admission.admission_order}
              onChange={(e) => setData('admission.admission_order', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors['admission.admission_order']} />
          </div>
        </div>

        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-2">
            <label htmlFor="admission_date" className="block text-sm font-medium">Data de Admissão</label>
            <input
              id="admission_date"
              name="admission_date"
              type="text"
              value={data.admission.admission_date}
              onChange={(e) => setData('admission.admission_date', maskDate(e.target.value))}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors['admission.admission_date']} />
          </div>

          <div className="col-span-12 md:col-span-2">
            <label htmlFor="admission_minute" className="block text-sm font-medium">Ata de Admissão</label>
            <input
              id="admission_minute"
              name="admission_minute"
              type="number"
              value={data.admission.admission_minute}
              onChange={(e) => setData('admission.admission_minute', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors['admission.admission_minute']} />
          </div>

          <div className="col-span-12 md:col-span-8">
            <label htmlFor="admission_reason" className="block text-sm font-medium">Motivo de Admissão</label>
            <select
              id="admission_reason"
              value={data.admission.admission_reason}
              onChange={(e) => setData('admission.admission_reason', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Batismo</option>
              <option value="2">Profissão de Fé</option>
              <option value="3">Batismo e Profissão de Fé</option>
              <option value="4">Transferência</option>
              <option value="5">Transferência de Responsáveis</option>
              <option value="6">Restauração</option>
              <option value="7">Jurisdição Ex-ofício</option>
              <option value="8">Jurisdição a Pedido</option>
              <option value="9">Jurisdição sobre os Responsáveis</option>
              <option value="10">Designação do Presbitério</option>
            </select>
            <InputError message={errors['admission.admission_reason']} />
          </div>
        </div>

        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-2">
            <label htmlFor="dismissal_date" className="block text-sm font-medium">Data de Demissão</label>
            <input
              id="dismissal_date"
              name="dismissal_date"
              type="text"
              value={data.admission.dismissal_date}
              onChange={(e) => setData('admission.dismissal_date', maskDate(e.target.value))}
              disabled={data.admission.membership_type !== '3'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors['admission.dismissal_date']} />
          </div>

          <div className="col-span-12 md:col-span-2">
            <label htmlFor="dismissal_minute" className="block text-sm font-medium">Ata de Demissão</label>
            <input
              id="dismissal_minute"
              name="dismissal_minute"
              type="number"
              value={data.admission.dismissal_minute}
              onChange={(e) => setData('admission.dismissal_minute', e.target.value)}
              disabled={data.admission.membership_type !== '3'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors['admission.dismissal_minute']} />
          </div>

          <div className="col-span-12 md:col-span-8">
            <label htmlFor="dismissal_reason" className="block text-sm font-medium">Motivo de Demissão</label>
            <select
              id="dismissal_reason"
              value={data.admission.dismissal_reason}
              onChange={(e) => setData('admission.dismissal_reason', e.target.value)}
              disabled={data.admission.membership_type !== '3'}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Transferência</option>
              <option value="2">Falecimento</option>
              <option value="3">Exclusão</option>
              <option value="4">Ordenação</option>
            </select>
            <InputError message={errors['admission.dismissal_reason']} />
          </div>
        </div>

        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-6">
            <label htmlFor="name" className="block text-sm font-medium">Nome</label>
            <input
              id="name"
              value={data.name}
              onChange={(e) => setData('name', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.name} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="gender" className="block text-sm font-medium">Gênero</label>
            <select
              id="gender"
              value={data.gender}
              onChange={(e) => setData('gender', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Masculino</option>
              <option value="2">Feminino</option>
            </select>
            <InputError message={errors.gender} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="birth_date" className="block text-sm font-medium">Data de Nascimento</label>
            <input
              id="birth_date"
              name="birth_date"
              type="text"
              value={data.birth_date}
              onChange={(e) => setData('birth_date', maskDate(e.target.value))}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.birth_date} />
          </div>
        </div>

        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-6">
            <label htmlFor="birthplace" className="block text-sm font-medium">Naturalidade</label>
            <input
              id="birthplace"
              value={data.birthplace}
              onChange={(e) => setData('birthplace', e.target.value)}
              placeholder='Cidade/UF'
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.birthplace} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="document_rg" className="block text-sm font-medium">RG</label>
            <input
              id="document_rg"
              value={data.document_rg}
              onChange={(e) => setData('document_rg', maskRg(e.target.value))}
              maxLength={12}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.document_rg} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="document_cpf" className="block text-sm font-medium">CPF</label>
            <input
              id="document_cpf"
              value={data.document_cpf}
              onChange={(e) => setData('document_cpf', maskCpf(e.target.value))}
              maxLength={14}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.document_cpf} />
          </div>
        </div>

        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-3">
            <label htmlFor="marital_status" className="block text-sm font-medium">Estado Civil</label>
            <select
              id="marital_status"
              value={data.marital_status}
              onChange={(e) => setData('marital_status', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Solteiro(a)</option>
              <option value="2">Casado(a)</option>
              <option value="3">Separado(a)</option>
              <option value="4">Viúvo(a)</option>
              <option value="5">Divorciado(a)</option>
              <option value="6">União Estável</option>
            </select>
            <InputError message={errors.marital_status} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="marriage_date" className="block text-sm font-medium">Data de Casamento</label>
            <input
              id="marriage_date"
              name="marriage_date"
              type="text"
              value={data.marriage_date}
              onChange={(e) => setData('marriage_date', maskDate(e.target.value))}
              disabled={data.marital_status !== '2' && data.marital_status !== '6'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.marriage_date} />
          </div>

          <div className="col-span-12 md:col-span-6">
            <label htmlFor="spouse_name" className="block text-sm font-medium">Nome do Cônjuge</label>
            <input
              id="spouse_name"
              value={data.spouse_name}
              onChange={(e) => setData('spouse_name', e.target.value)}
              disabled={data.marital_status !== '2' && data.marital_status !== '6'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.spouse_name} />
          </div>
        </div>

        <div className="grid grid-cols-2 gap-4">
          <div>
            <label htmlFor="father_name" className="block text-sm font-medium">Nome do Pai</label>
            <input
              id="father_name"
              value={data.father_name}
              onChange={(e) => setData('father_name', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.father_name} />
          </div>

          <div>
            <label htmlFor="mother_name" className="block text-sm font-medium">Nome da Mãe</label>
            <input
              id="mother_name"
              value={data.mother_name}
              onChange={(e) => setData('mother_name', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.mother_name} />
          </div>
        </div>

        <div className="grid grid-cols-2 gap-4">
          <div>
            <label htmlFor="educational_level" className="block text-sm font-medium">Escolaridade</label>
            <select
              id="educational_level"
              value={data.educational_level}
              onChange={(e) => setData('educational_level', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Ensino Fundamental Incompleto</option>
              <option value="2">Ensino Fundamental Completo</option>
              <option value="3">Ensino Médio Incompleto</option>
              <option value="4">Ensino Médio Completo</option>
              <option value="5">Graduação Incompleta</option>
              <option value="6">Graduação Completa</option>
              <option value="7">Pós-Graduação</option>
              <option value="8">Mestrado</option>
              <option value="9">Doutorado</option>
              <option value="10">Pós-Doutorado</option>
            </select>
            <InputError message={errors.educational_level} />
          </div>

          <div>
            <label htmlFor="occupation" className="block text-sm font-medium">Profissão</label>
            <input
              id="occupation"
              value={data.occupation}
              onChange={(e) => setData('occupation', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.occupation} />
          </div>
        </div>

        <div className="grid grid-cols-4 gap-4">
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
            <label htmlFor="secondary_phone" className="block text-sm font-medium">Telefone Secundário</label>
            <input
              id="secondary_phone"
              name="secondary_phone"
              value={data.secondary_phone}
              onChange={(e) => setData('secondary_phone', maskPhone(e.target.value))}
              placeholder='Somente números'
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.secondary_phone} />
          </div>

          <div>
            <label htmlFor="mobile_phone" className="block text-sm font-medium">Celular</label>
            <input
              id="mobile_phone"
              name="mobile_phone"
              value={data.mobile_phone}
              onChange={(e) => setData('mobile_phone', maskPhone(e.target.value))}
              placeholder='Somente números'
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.mobile_phone} />
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

        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-6">
            <label htmlFor="street" className="block text-sm font-medium">Rua</label>
            <input
              id="street"
              value={postalCodeLoading ? '...' : data.street}
              disabled={postalCodeLoading}
              onChange={(e) => setData('street', e.target.value)}
              readOnly
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.street} />
          </div>

          <div className="col-span-12 md:col-span-2">
            <label htmlFor="number" className="block text-sm font-medium">Número</label>
            <input
              id="number"
              ref={numberRef}
              value={data.number}
              onChange={(e) => setData('number', e.target.value)}
              maxLength={6}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.number} />
          </div>

          <div className="col-span-12 md:col-span-4">
            <label htmlFor="complement" className="block text-sm font-medium">Complemento</label>
            <input
              id="complement"
              value={data.complement}
              onChange={(e) => setData('complement', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.complement} />
          </div>
        </div>

        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-4">
            <label htmlFor="neighborhood" className="block text-sm font-medium">Bairro</label>
            <input
              id="neighborhood"
              value={postalCodeLoading ? '...' : data.neighborhood}
              disabled={postalCodeLoading}
              onChange={(e) => setData('neighborhood', e.target.value)}
              readOnly
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.neighborhood} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="postal_code" className="block text-sm font-medium">CEP</label>
            <input
              id="postal_code"
              value={data.postal_code}
              onChange={(e) => handlePostalCodeChange(e.target.value)}
              maxLength={9}
              inputMode="numeric"
              placeholder="00000-000"
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.postal_code || postalCodeError || undefined} />
          </div>

          <div className="col-span-12 md:col-span-3">
            <label htmlFor="city" className="block text-sm font-medium">Cidade</label>
            <input
              id="city"
              value={postalCodeLoading ? '...' : data.city}
              disabled={postalCodeLoading}
              onChange={(e) => setData('city', e.target.value)}
              readOnly
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.city} />
          </div>

          <div className="col-span-12 md:col-span-2">
            <label htmlFor="state" className="block text-sm font-medium">UF</label>
            <input
              id="state"
              value={postalCodeLoading ? '...' : data.state}
              disabled={postalCodeLoading}
              onChange={(e) => setData('state', e.target.value.toUpperCase())}
              maxLength={2}
              readOnly
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.state} />
          </div>
        </div>

        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-2">
            <label htmlFor="is_baptized" className="block text-sm font-medium">Batizado</label>
            <select
              id="is_baptized"
              value={data.is_baptized}
              onChange={(e) => setData('is_baptized', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>
            <InputError message={errors.is_baptized} />
          </div>

          <div className="col-span-12 md:col-span-2">
            <label htmlFor="baptism_date" className="block text-sm font-medium">Data do Batismo</label>
            <input
              id="baptism_date"
              name="baptism_date"
              type="text"
              value={data.baptism_date}
              onChange={(e) => setData('baptism_date', maskDate(e.target.value))}
              disabled={data.is_baptized !== '1'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.baptism_date} />
          </div>

          <div className="col-span-12 md:col-span-4">
            <label htmlFor="baptism_church" className="block text-sm font-medium">Igreja do Batismo</label>
            <input
              id="baptism_church"
              value={data.baptism_church}
              onChange={(e) => setData('baptism_church', e.target.value)}
              disabled={data.is_baptized !== '1'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.baptism_church} />
          </div>

          <div className="col-span-12 md:col-span-4">
            <label htmlFor="baptism_pastor" className="block text-sm font-medium">Pastor do Batismo</label>
            <input
              id="baptism_pastor"
              value={data.baptism_pastor}
              onChange={(e) => setData('baptism_pastor', e.target.value)}
              disabled={data.is_baptized !== '1'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.baptism_pastor} />
          </div>
        </div>

        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-12 md:col-span-2">
            <label htmlFor="has_professed_faith" className="block text-sm font-medium">Professou a Fé</label>
            <select
              id="has_professed_faith"
              value={data.has_professed_faith}
              onChange={(e) => setData('has_professed_faith', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            >
              <option value="">Selecione</option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>
            <InputError message={errors.has_professed_faith} />
          </div>

          <div className="col-span-12 md:col-span-2">
            <label htmlFor="profession_of_faith_date" className="block text-sm font-medium">Data da Profissão de Fé</label>
            <input
              id="profession_of_faith_date"
              name="profession_of_faith_date"
              type="text"
              value={data.profession_of_faith_date}
              onChange={(e) => setData('profession_of_faith_date', maskDate(e.target.value))}
              disabled={data.has_professed_faith !== '1'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.profession_of_faith_date} />
          </div>

          <div className="col-span-12 md:col-span-4">
            <label htmlFor="profession_of_faith_church" className="block text-sm font-medium">Igreja da Profissão de Fé</label>
            <input
              id="profession_of_faith_church"
              value={data.profession_of_faith_church}
              onChange={(e) => setData('profession_of_faith_church', e.target.value)}
              disabled={data.has_professed_faith !== '1'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.profession_of_faith_church} />
          </div>

          <div className="col-span-12 md:col-span-4">
            <label htmlFor="profession_of_faith_pastor" className="block text-sm font-medium">Pastor da Profissão de Fé</label>
            <input
              id="profession_of_faith_pastor"
              value={data.profession_of_faith_pastor}
              onChange={(e) => setData('profession_of_faith_pastor', e.target.value)}
              disabled={data.has_professed_faith !== '1'}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.profession_of_faith_pastor} />
          </div>
        </div>

        <div className="grid grid-cols-1 gap-4">
          <div>
            <label htmlFor="last_church" className="block text-sm font-medium">Última Igreja</label>
            <input
              id="last_church"
              value={data.last_church}
              onChange={(e) => setData('last_church', e.target.value)}
              className="mt-1 w-full rounded-md border p-2"
            />
            <InputError message={errors.last_church} />
          </div>
        </div>

        <div className="flex gap-3">
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
