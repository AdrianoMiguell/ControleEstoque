<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UnidadeEstoque extends Model
{
    protected $fillable = [
        'id',
        'descricao',
        'sigla',
        'isGlobal',
        'user_id'
    ];

    public function Produto()
    {
        return $this->hasMany(Produto::class);
    }

    public function scopeForUser($query, $userId) {
        return $query->where('isGlobal', true)->orWhere('user_id', $userId);
    }

}
