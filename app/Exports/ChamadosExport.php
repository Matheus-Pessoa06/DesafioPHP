<?php

namespace App\Exports;

use App\Models\Chamado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChamadosExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Chamado::with(['responsavel', 'categoria']);

        if (!empty($this->filters['categoria'])) {
            $query->where('categoria_id', $this->filters['categoria']);
        }
        if (!empty($this->filters['prioridade'])) {
            $query->where('prioridade', $this->filters['prioridade']);
        }
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        return $query->get();
    }

    public function map($chamado): array
    {
        return [
            $chamado->titulo,
            $chamado->descricao,
            $chamado->responsavel->name ?? 'Não atribuído',
            $chamado->prioridade,
            $chamado->categoria->nome ?? '',
            $chamado->status,
            $chamado->created_at->format('d/m/Y H:i'),
            $chamado->updated_at->format('d/m/Y H:i'),
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