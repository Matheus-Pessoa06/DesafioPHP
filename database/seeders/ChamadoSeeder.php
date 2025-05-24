<?php

namespace Database\Seeders;

use App\Models\Chamado;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChamadoSeeder extends Seeder
{
    public function run(): void
    {
        $colaborador = User::where('role', 'colaborador')->first();

        $chamados = [
            [
                'titulo' => 'Problema com internet',
                'descricao' => 'Sem acesso à internet no setor de TI.',
                'categoria' => 'TI',
                'prioridade' => 'Alta',
                'responsavel' => 'Matheus',
            ],
            [
                'titulo' => 'Lâmpada queimada',
                'descricao' => 'Lâmpada do corredor principal está queimada.',
                'categoria' => 'Manutenção',
                'prioridade' => 'Média',
                'responsavel' => 'Alexandre',
            ],
            [
                'titulo' => 'Erro no sistema de ponto',
                'descricao' => 'Sistema de registro de ponto não está funcionando.',
                'categoria' => 'TI',
                'prioridade' => 'Alta',
                'responsavel' => 'Garcia',
            ],
            [
                'titulo' => 'Solicitação de cadeira ergonômica',
                'descricao' => 'Solicitação de troca por cadeira ergonômica.',
                'categoria' => 'Suporte RH',
                'prioridade' => 'Baixa',
                'responsavel' => 'Matheus',
            ],
            [
                'titulo' => 'Impressora com atolamento',
                'descricao' => 'Impressora da recepção está com papel atolado.',
                'categoria' => 'TI',
                'prioridade' => 'Média',
                'responsavel' => 'Alexandre',
            ],
        ];

        foreach ($chamados as $dados) {
            Chamado::updateOrCreate(
                ['titulo' => $dados['titulo']],
                [
                    'descricao' => $dados['descricao'],
                    'categoria' => $dados['categoria'],
                    'prioridade' => $dados['prioridade'],
                    'status' => 'Aberto',
                    'responsavel' => $dados['responsavel'],
                    'user_id' => $colaborador->id,
                ]
            );
        }
    }
}
