<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movimentacao>
 */
class MovimentacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = fake()->randomElement(['0', '1']);
        $destino_id = $tipo == '0' ? fake()->numberBetween(1, 5) : null;
        $fornecedor_id = $tipo == '0' ? null : fake()->randomElement([1, 2]);
        $produto = Produto::inRandomOrder()->first();
        $quantidade = fake()->numberBetween(10, 25);
        $controle_valor = $tipo ? 1 : -1;
        $valor_unitario = $produto ? $produto->preco * $controle_valor : 0;

        return [
            'tipo' => $tipo,
            'quantidade' => $quantidade,
            'valor_unitario' => $valor_unitario,
            'valor_total' => $valor_unitario * $quantidade,
            'produto_id' => $produto ? $produto->id : null,
            'destino_id' => $destino_id,
            'fornecedor_id' => $fornecedor_id,
            'user_id' => 2
        ];
    }
}
