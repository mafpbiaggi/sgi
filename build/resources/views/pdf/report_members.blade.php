<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        {!! file_get_contents(resource_path('css/report.css')) !!}
    </style>
</head>

<body>
    <sethtmlpagefooter name="paginator" value="on" />

    <table class="header">
        <th></th>
        <tr>
            <td class="header-title">
                <h1>{{ $title }}</h1>
            </td>
            <td class="header-date">Gerado em: {{ $generate_date }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Situação</th>
                <th>Data de Nascimento</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
            <tr>
                <td>{{ $member->currentAdmission?->admission_order }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->currentAdmission?->membership_type_label }}</td>
                <td>{{ $member->currentAdmission?->membership_status_label }}</td>
                <td>{{ $member->birth_date?->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">Nenhum membro encontrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <htmlpagefooter name="paginator">
        <div class="footer">
            Página {PAGENO} de {nbpg}
        </div>
    </htmlpagefooter>
</body>

</html>
