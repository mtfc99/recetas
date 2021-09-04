<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesRecetasPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes_receta', function (Blueprint $table) {
            $table->id();
          /*  Anteriormente habíamos escrito el siguiente código para linkear foreign keys.
$table->foreignId('user_id')->references('id')->on('users');*/

            $table->foreignId('user_id')->constrained();
            $table->foreignId('receta_id')->constrained();
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
        Schema::dropIfExists('likes_receta');
    }
}
