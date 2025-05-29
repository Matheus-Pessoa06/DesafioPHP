<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Chamados</title>
    <style>
        /* Estilos gerais para tela */
        body {
            font-family: sans-serif;
            margin: 20px; /* Margem padrão para visualização em tela */
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto; /* Centraliza a tabela na tela */
            table-layout: fixed; /* Ajuda a controlar a largura das colunas */
        }
        th, td {
            border: 1px solid #000;
            padding: 8px; /* Aumentei um pouco o padding para melhor legibilidade */
            text-align: left;
            word-wrap: break-word; /* Garante que o texto longo quebre a linha */
        }
        th {
            background-color: #eee;
            font-weight: bold;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Estilos específicos para impressão (PDF) */
        @media print {
            body {
                margin: 1cm; /* Margens para impressão para evitar corte */
                padding: 0;
                font-size: 10pt; /* Tamanho de fonte menor para impressão */
            }
            table {
                width: 100%; /* Garante que a tabela ocupe a largura total da área imprimível */
                margin: 0 auto; /* Centraliza novamente para impressão */
            }
            th, td {
                padding: 5px; /* Reduzi o padding para caber mais conteúdo */
                font-size: 9pt; /* Ajuste fino do tamanho da fonte para células */
            }
            /* Opcional: Quebra de página antes de cada tabela se houver múltiplas */
            /* table { page-break-after: always; } */
        }
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