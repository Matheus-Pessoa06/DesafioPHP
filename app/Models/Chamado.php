<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = [
        'user_id',       
        'tecnico_id',    
        'titulo',
        'descricao',
        'categoria',   
        'prioridade',   
        'status',  
        'anexo',        
        'responsavel',   
    ];

    public function respostas() {
        return $this->hasMany(Resposta::class);
    }
}
