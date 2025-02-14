<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Destino extends Model
{
    protected $fillable = [
        'nome',
        'tipo',
        'descricao',
        'user_id',
    ];

    public function movimentacao()
    {
        return $this->hasMany(movimentacao::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('userPosts', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('destinos.user_id', Auth::user()->id);
            }
        });
    }
}
