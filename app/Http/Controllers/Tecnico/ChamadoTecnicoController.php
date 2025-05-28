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

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('prioridade')) {
            $query->where('prioridade', $request->prioridade);
        }

        $chamados = $query->latest()->get();

        return Inertia::render('Tecnico/Chamados/Index', [
            'chamados' => $chamados,
            'filters' => $request->only(['status', 'prioridade']),
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
        $request->validated();

        $chamado->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status atualizado.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Aberto,Em atendimento,Resolvido,Fechado',
        ]);

        $chamado = Chamado::findOrFail($id);

        if(auth()->user()->role !== 'tecnico'){
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $chamado->status = $request->status;
        $chamado->save();

        return response()->json(['message' => 'Status atualizado com sucesso']);
    }
}

