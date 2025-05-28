<?php

namespace App\Http\Controllers;

use App\Exports\ChamadosExport;
use App\Models\Chamado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $filters = $request->only(['categoria', 'prioridade', 'status']);

        return Excel::download(new ChamadosExport($filters), 'chamados.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $chamados = Chamado::with(['responsavel', 'categoria'])
            ->when($request->categoria, fn($q) => $q->where('categoria_id', $request->categoria))
            ->when($request->prioridade, fn($q) => $q->where('prioridade', $request->prioridade))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->get();

        $pdf = Pdf::loadView('pdf.chamados', compact('chamados'));

        return $pdf->download('chamados.pdf');
    }
}
