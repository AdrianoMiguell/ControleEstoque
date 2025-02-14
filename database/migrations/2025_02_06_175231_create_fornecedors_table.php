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
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('identificacao', 14)->comment("CPF ou CNPJ")->unique();
            $table->string('telefone', 25)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('cep', 8);
            $table->string('estado', 50);
            $table->string('cidade', 100);
            $table->string('bairro', 100);
            $table->string('rua', 100);
            $table->integer('numero');
            $table->string('complemento', 500)->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedors');
    }
};
