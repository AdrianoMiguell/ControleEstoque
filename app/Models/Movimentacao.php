<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Throwable;

class Movimentacao extends Model
{
    /** @use HasFactory<\Database\Factories\MovimentacaoFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'tipo',
        'quantidade',
        'valor_unitario',
        'valor_total',
        'produto_id',
        'destino_id',
        'fornecedor_id',
        'user_id',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('userPosts', function (Builder $builder) {
            $builder->where('movimentacaos.user_id', Auth::id());
        });
    }
}
