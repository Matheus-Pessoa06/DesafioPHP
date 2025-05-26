<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ApenasTexto;

class ChamadoTecnicoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mensagem' => ['required', 'max:255', new ApenasTexto()],
            'status' => 'required|in:Aberto,Em atendimento,Resolvido,Fechado',
        ];
    }

    public function messages(): array
    {
        return [
            'mensagem.required' => 'O campo mensagem é obrigatório.',

            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O status deve ser um dos seguintes: Aberto, Em atendimento, Resolvido ou Fechado.',
        ];
    }
}
