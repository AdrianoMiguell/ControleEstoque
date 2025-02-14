<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('descricao', 500)->nullable();
            $table->decimal('preco', 10, 2)->comment("Preço de unidade salvo em decimal, com duas casas representando os centavos.");
            $table->integer('estoque');
            $table->foreignId('unidade_estoque_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
