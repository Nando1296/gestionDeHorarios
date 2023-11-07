<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionalidadRolPrivilegiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionalidad_rol_privilegios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcionalidad_id')->constrained('funcionalidades');
            $table->foreignId('rol_id')->constrained('rols');
            $table->boolean('listar');
            $table->boolean('nuevo');
            $table->boolean('ver');
            $table->boolean('modificar');
            $table->boolean('eliminar');
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
        Schema::dropIfExists('funcionalidad_rol_privilegios');
    }
}
