<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ApenasTexto;

class ChamadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'max:255', new ApenasTexto()],
            'descricao' => 'required',
            'categoria' => 'required|string',
            'prioridade' => 'required|in:Baixa,Média,Alta',
            'anexo' => 'nullable|file|max:2048',
            'responsavel' => ['required', 'max:255', new ApenasTexto()],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais que 255 caracteres.',
            
            'descricao.required' => 'A descrição é obrigatória.',
            
            'categoria.required' => 'A categoria é obrigatória.',
            
            'prioridade.required' => 'A prioridade é obrigatória.',
            'prioridade.in' => 'A prioridade deve ser Baixa, Média ou Alta.',
            
            'anexo.file' => 'O anexo deve ser um arquivo.',
            'anexo.max' => 'O anexo não pode ultrapassar 2MB.',
            
            'responsavel.required' => 'O campo responsável é obrigatório.',
            'responsavel.max' => 'O responsável não pode ter mais que 255 caracteres.',
        ];
    }
}
