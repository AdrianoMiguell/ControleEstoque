<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Produto extends Model
{
    /** @use HasFactory<\Database\Factories\ProdutoFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'preco',
        'estoque',
        'unidade_estoque_id',
        'user_id',
    ];

    public function unidadeEstoque() {
        return $this->belongsTo(UnidadeEstoque::class, 'unidade_estoque_id', 'id');
    }

    public function Movimentacao() {
        return $this->hasMany(Movimentacao::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('userPosts', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('produtos.user_id', Auth::id());
            }
        });
    }
}
