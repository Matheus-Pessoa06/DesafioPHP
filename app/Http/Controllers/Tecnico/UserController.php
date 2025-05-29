<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();

        return Inertia::render('Tecnico/Usuarios/Index', [
            'users' => $users,
        ]);
    }

    public function toggleActive(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return back()->with('success', 'Status do usuário atualizado.');
    }

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
