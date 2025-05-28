<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    // Lista os usuários
    public function index()
    {
        $users = User::orderBy('name')->get();

        return Inertia::render('Tecnico/Usuarios/Index', [
            'users' => $users,
        ]);
    }

    // Ativa/desativa usuário
    public function toggleActive(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return back()->with('success', 'Status do usuário atualizado.');
    }

    // Altera perfil do usuário entre colaborador e técnico
    public function changeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:colaborador,tecnico',
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Perfil do usuário atualizado.');
    }
}
