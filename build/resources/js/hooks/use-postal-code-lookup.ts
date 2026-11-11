import { useCallback, useEffect, useRef, useState } from "react";
import {
    type AddressFields,
    PostalCodeError,
    fetchAddressByPostalCode,
} from "@/lib/postal-code";
import { maskPostalCode } from "@/lib/masks";

type UpdateAddress = (fields: Partial<AddressFields>) => void;

export function usePostalCodeLookup(update: UpdateAddress) {
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState<string | null>(null);

    const abortRef = useRef<AbortController | null>(null);
    const numberRef = useRef<HTMLInputElement>(null);

    const updateRef = useRef(update);
    updateRef.current = update;

    useEffect(() => () => abortRef.current?.abort(), []);

    const lookup = useCallback(async (digits: string) => {
        abortRef.current?.abort();

        const controller = new AbortController();
        abortRef.current = controller;
        setError(null);
        setLoading(true);

        try {
            const result = await fetchAddressByPostalCode(
                digits,
                controller.signal,
            );
            updateRef.current(result);
            numberRef.current?.focus();
        } catch (err) {
            if ((err as Error).name === "AbortError") return;

            setError(
                err instanceof PostalCodeError
                    ? err.message
                    : "Erro ao consultar o CEP.",
            );
        } finally {
            if (abortRef.current === controller) setLoading(false);
        }
    }, []);

    const handlePostalCodeChange = useCallback(
        (value: string) => {
            const masked = maskPostalCode(value);
            updateRef.current({ postal_code: masked });

            const digits = masked.replace(/\D/g, "");

            if (digits.length === 8) {
                void lookup(digits);
                return;
            }

            abortRef.current?.abort();
            setLoading(false);
            setError(null);
        },
        [lookup],
    );

    return { loading, error, numberRef, handlePostalCodeChange };
}