<?php

namespace App\Http\Controllers;

use App\Exports\ChamadosExport;
use App\Models\Chamado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $chamados = DB::table('chamados')
            ->leftJoin('users', 'chamados.user_id', '=', 'users.id')
            ->leftJoin('categorias', 'chamados.categoria_id', '=', 'categorias.id')
            ->select(
                'chamados.*',
                'users.name as responsavel_nome',
                'categorias.nome as categoria_nome'
            )
            ->when($request->categoria, fn($q) => $q->where('chamados.categoria_id', $request->categoria))
            ->when($request->prioridade, fn($q) => $q->where('chamados.prioridade', $request->prioridade))
            ->when($request->status, fn($q) => $q->where('chamados.status', $request->status))
            ->get();

        return Excel::download(new \App\Exports\ChamadosExportQueryBuilder($chamados), 'chamados.xlsx');
    }



    public function exportPdf(Request $request)
    {
        $chamados = DB::table('chamados')
        ->leftJoin('users', 'chamados.user_id', '=', 'users.id')
        ->select(
            'chamados.*',
            'users.name as responsavel_nome'
        )
        ->when($request->categoria, fn($q) => $q->where('chamados.categoria_id', $request->categoria))
        ->when($request->prioridade, fn($q) => $q->where('chamados.prioridade', $request->prioridade))
        ->when($request->status, fn($q) => $q->where('chamados.status', $request->status))
        ->get();


        $pdf = Pdf::loadView('pdf.chamados', compact('chamados'));

        return $pdf->download('chamados.pdf');
    }
}
