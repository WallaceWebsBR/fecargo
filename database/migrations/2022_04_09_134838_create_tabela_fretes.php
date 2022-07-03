<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelaFretes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabela_fretes', function (Blueprint $table) {
            $table->id();
            $table->string('uf', 2);
            $table->string('cidade', 100);
            $table->string('taxa_minima', 100)->default(120);
            $table->string('por_kg', 100)->default(0);	
            $table->string('por_km', 100)->default(0);
            $table->string('nome_tabela', 100)->default('tabela_principal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabela_fretes');
    }
}
