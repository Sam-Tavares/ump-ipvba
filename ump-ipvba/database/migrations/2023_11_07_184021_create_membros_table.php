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
        Schema::create('membros', function (Blueprint $table) {
            $table->id();
            $table->string('Nome',100);
            $table->date('data_nasc');
            $table->string('email',100);
            $table->string('rede',100);
            $table->string('telefone',100);
            $table->string('rua',100);
            $table->string('bairro',100);
            $table->string('cidade',100);
            $table->string('estado',100);
            $table->string('cep',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membros');
    }
};
