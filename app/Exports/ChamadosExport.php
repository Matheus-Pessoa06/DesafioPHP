<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;

class ChamadosExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = DB::table('chamados')
            ->leftJoin('users', 'chamados.user_id', '=', 'users.id')
            ->leftJoin('categorias', 'chamados.categoria_id', '=', 'categorias.id')
            ->select(
                'chamados.titulo',
                'chamados.descricao',
                'users.name as responsavel_nome',
                'chamados.prioridade',
                'categorias.nome as categoria_nome',
                'chamados.status',
                'chamados.created_at',
                'chamados.updated_at'
            );

        if (!empty($this->filters['categoria'])) {
            $query->where('chamados.categoria_id', $this->filters['categoria']);
        }
        if (!empty($this->filters['prioridade'])) {
            $query->where('chamados.prioridade', $this->filters['prioridade']);
        }
        if (!empty($this->filters['status'])) {
            $query->where('chamados.status', $this->filters['status']);
        }

        return $query->get();
    }

    public function map($chamado): array
    {
        return [
            $chamado->titulo,
            $chamado->descricao,
            $chamado->responsavel_nome ?? 'Não atribuído',
            $chamado->prioridade,
            $chamado->categoria_nome ?? '',
            $chamado->status,
            date('d/m/Y H:i', strtotime($chamado->created_at)),
            date('d/m/Y H:i', strtotime($chamado->updated_at)),
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
