<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{
    public function index()
    {
        return inertia('Categorias/Index', [
            'categorias' => Categoria::all()
        ]);
    }

    public function create()
    {
        return inertia('Categorias/Create');
        
    }

    public function store(CategoriaRequest $request)
    {
        $request->validated();

        Categoria::create($request->only('nome'));

        return redirect()->route('chamados.index')->with('success', 'Categoria criada com sucesso.');
    }

    public function edit(Categoria $categoria)
    {
        return inertia('Categorias/Edit', [
            'categoria' => $categoria
        ]);
    }

    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $request->validated();

        $categoria->update($request->only('nome'));

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria removida com sucesso.');
    }
}
?>