<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Chamado;
use Illuminate\Http\Request;
use App\Http\Requests\ChamadoTecnicoRequest;
use Inertia\Inertia;

class ChamadoTecnicoController extends Controller
{
    public function index(Request $request)
    {
        $query = Chamado::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('prioridade')) {
            $query->where('prioridade', $request->prioridade);
        }

        $chamados = $query->latest()->get();

        return Inertia::render('Tecnico/Chamados', [
            'chamados' => $chamados,
            'filters' => $request->only(['status', 'prioridade']), // Opcional, para manter selecionado no front
        ]);
    }

    public function show(Chamado $chamado)
    {
        return Inertia::render('Tecnico/Chamados/Show', compact('chamado'));
    }

    public function responder(ChamadoTecnicoRequest $request, Chamado $chamado)
    {
        $request->validated();

        $chamado->respostas()->create([
            'user_id' => auth()->id(),
            'mensagem' => $request->mensagem,
        ]);

        return back()->with('success', 'Resposta enviada.');
    }

    public function alterarStatus(ChamadoTecnicoRequest $request, Chamado $chamado)
    {
        $request->validate();

        $chamado->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status atualizado.');
    }
}

