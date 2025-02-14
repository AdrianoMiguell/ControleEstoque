<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'nome' => fake()->realText(20, 5),
            // 'descricao' => fake()->realText(400, 50),
            // 'unidade_medida' => fake()->randomElement(['kg', '']),
            // 'user_id' => 1,
            // // $table->string('nome', 50);
            // // $table->string('descrição', 500);
            // // $table->string('unidade_medida', 20);
            // // $table->decimal('preco', 10, 2)->comment("Preço de unidade salvo em decimal, com duas casas representando os centavos.");
            // // $table->integer('estoque');
            // // $table->timestamps();
        ];
    }
}
