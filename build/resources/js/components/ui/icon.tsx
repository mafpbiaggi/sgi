import type { LucideIcon } from 'lucide-react';

interface IconProps {
    readonly iconNode?: LucideIcon | null;
    readonly className?: string;
}

export function Icon({ iconNode: IconComponent, className }: IconProps) {
    if (!IconComponent) {
        return null;
    }

    return <IconComponent className={className} />;
}
