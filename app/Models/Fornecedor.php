<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fornecedor extends Model
{
    /** @use HasFactory<\Database\Factories\FornecedorFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'identificacao',
        'telefone',
        'email',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'rua',
        'numero',
        'complemento',
        'user_id',
    ];

    public function Movimentacao() {
        $this->hasMany(Movimentacao::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('userPosts', function (Builder $builder) {
            // Adiciona o filtro automático para o usuário autenticado
            if (Auth::check()) {
                $builder->where('fornecedors.user_id', Auth::id());
            }
        });
    }

}
