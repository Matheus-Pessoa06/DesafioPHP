<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChamadosExportQueryBuilder implements FromCollection, WithHeadings, WithMapping
{
    protected $chamados;

    public function __construct($chamados)
    {
        $this->chamados = $chamados;
    }

    public function collection()
    {
        return $this->chamados;
    }

    public function map($chamado): array
    {
        return [
            $chamado->titulo,
            $chamado->descricao,
            $chamado->responsavel ?? 'Não atribuído',
            $chamado->prioridade,
            $chamado->categoria ?? '',
            $chamado->status,
            \Carbon\Carbon::parse($chamado->created_at)->format('d/m/Y H:i'),
            \Carbon\Carbon::parse($chamado->updated_at)->format('d/m/Y H:i'),
        ];
    }

    public function headings(): array
    {
        return [
            'Título',
            'Descrição',
            'Responsável',
            'Prioridade',
            'Categoria',
            'Status',
            'Criado em',
            'Atualizado em',
        ];
    }
}
?>