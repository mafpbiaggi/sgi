export interface AddressFields {
    street: string;
    number: string;
    neighborhood: string;
    postal_code: string;
    city: string;
    state: string;
}

export const emptyAddress: AddressFields = {
    street: "",
    number: "",
    neighborhood: "",
    postal_code: "",
    city: "",
    state: "",
};

interface ViaCepResponse {
    cep?: string;
    logradouro?: string;
    bairro?: string;
    localidade?: string;
    uf?: string;
    erro?: boolean | string;
}

export type PostalCodeLookup = Pick<
    AddressFields,
    "street" | "neighborhood" | "city" | "state"
>;

export class PostalCodeError extends Error {
    constructor(
        public readonly kind: "invalid" | "not_found" | "network",
        message: string,
    ) {
        super(message);
        this.name = "PostalCodeError";
    }
}

export async function fetchAddressByPostalCode(
    value: string,
    signal?: AbortSignal,
): Promise<PostalCodeLookup> {
    const cep = value.replace(/\D/g, "");

    if (!/\d{8}$/.test(cep)) {
        throw new PostalCodeError("invalid", "Formato de CEP inválido.");
    }

    let data: ViaCepResponse;

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`, {
            signal,
        });

        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }

        data = (await response.json()) as ViaCepResponse;
    } catch (error) {
        if ((error as Error).name === "AbortError") {
            throw error;
        }

        throw new PostalCodeError(
            "network",
            "Não foi possível consultar o CEP.",
        );
    }

    if (data.erro) {
        throw new PostalCodeError("not_found", "CEP não encontrado.");
    }

    return {
        street: data.logradouro ?? "",
        neighborhood: data.bairro ?? "",
        city: data.localidade ?? "",
        state: data.uf ?? "",
    };
}
