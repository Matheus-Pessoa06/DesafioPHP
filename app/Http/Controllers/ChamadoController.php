<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Http\Request;
use App\Http\Requests\ChamadoRequest;
use App\Models\Categoria;
use Inertia\Inertia;

class ChamadoController extends Controller
{
    public function index(Request $request)
{
    // Pegue os filtros da request
    $status = $request->input('status');
    $prioridade = $request->input('prioridade');

    // Busque os chamados do usuário autenticado
    $query = auth()->user()->chamados()->latest();

    // Aplique os filtros se estiverem presentes
    if ($status) {
        $query->where('status', $status);
    }

    if ($prioridade) {
        $query->where('prioridade', $prioridade);
    }

    // Obtenha os chamados filtrados
    $chamados = $query->get();

    // Retorne para a view com os filtros aplicados
    return Inertia::render('Chamados/Index', [
        'chamados' => $chamados,
        'filters' => [
            'status' => $status,
            'prioridade' => $prioridade,
        ],
    ]);
}

    public function create()
    {
        return Inertia::render('Chamados/Create', [
            'categorias' => Categoria::orderBy('nome')->get(),
        ]);
    }

    public function store(ChamadoRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('anexo')) {
            $data['anexo'] = $request->file('anexo')->store('anexos', 'public');
        }

        $request->user()->chamados()->create($data);

        return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso.');
    }

    public function show(Chamado $chamado)
    {
        return Inertia::render('Chamados/Show', [
            'chamado' => [
                'id' => $chamado->id,
                'titulo' => $chamado->titulo,
                'descricao' => $chamado->descricao,
                'categoria' => $chamado->categoria,
                'status' => $chamado->status,
                'responsavel' => $chamado->responsavel,
                'created_at' => $chamado->created_at->format('d-m-Y H:i:s'),
                'updated_at' => $chamado->updated_at->format('d-m-Y H:i:s'),
            ]
        ]);
    }
}

