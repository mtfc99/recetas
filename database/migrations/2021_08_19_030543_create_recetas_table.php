<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('categoria_recetas', function (Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->timestamps();        
        });
        
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
//string('titulo') es para indicar que la nueva columna de la BBDD es un string, y su nombre es titulo
//es el primer paso para agregar un campo a una BBDD
            $table->string('titulo'); //tiene que ser el mismo name del input del formulario
            $table->text('ingredientes');
            $table->text('preparacion');
            $table->string('imagen');
//foreignId es para llamar al ID de otra tabla. Como Foreign Key.
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('categoria_id')->references('id')->on('categoria_recetas');
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
        Schema::dropIfExists('categoria_receta');
        Schema::dropIfExists('recetas');
    }
}
