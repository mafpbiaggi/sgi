export function maskPhone(value: string): string {
    const digits = value.replace(/\D/g, "").slice(0, 11);

    if (digits.length <= 10) {
        return digits
            .replace(/(\d{2})(\d)/, "($1) $2")
            .replace(/(\d{4})(\d)/, "$1-$2");
    }

    return digits
        .replace(/(\d{2})(\d)/, "($1) $2")
        .replace(/(\d{5})(\d)/, "$1-$2");
}

export function maskDate(value: string): string {
    const digits = value.replace(/\D/g, "").slice(0, 8);

    return digits
        .replace(/(\d{2})(\d)/, "$1/$2")
        .replace(/(\d{2})(\d)/, "$1/$2");
}

export function maskRg(value: string): string {
    const clean = value.toUpperCase().replace(/[^0-9X]/g, "");
    // o X só é aceito na 9ª posição (dígito verificador)
    const chars = clean
        .replace(/X/g, (_, index) => (index === 8 ? "X" : ""))
        .slice(0, 9);

    return chars
        .replace(/(\d{2})(\d)/, "$1.$2")
        .replace(/(\d{3})(\d)/, "$1.$2")
        .replace(/(\d{3})([0-9X])$/, "$1-$2");
}

export function maskCpf(value: string): string {
    const digits = value.replace(/\D/g, "").slice(0, 11);

    return digits
        .replace(/(\d{3})(\d)/, "$1.$2")
        .replace(/(\d{3})(\d)/, "$1.$2")
        .replace(/(\d{3})(\d{1,2})$/, "$1-$2");
}

export function maskPostalCode(value: string): string {
    const digits = value.replace(/\D/g, "").slice(0, 9);

    return digits
        .replace(/(\d{5})(\d)/, "$1-$2")
}
