<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Chamados</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Relatório de Chamados</h2>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Responsável</th>
                <th>Prioridade</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chamados as $chamado)
                <tr>
                    <td>{{ $chamado->titulo }}</td>
                    <td>{{ $chamado->descricao }}</td>
                    <td>{{ $chamado->responsavel ?? 'Não atribuído' }}</td>
                    <td>{{ $chamado->prioridade }}</td>
                    <td>{{ $chamado->categoria ?? '' }}</td>
                    <td>{{ $chamado->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($chamado->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($chamado->updated_at)->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
