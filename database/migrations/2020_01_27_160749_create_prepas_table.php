<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrepasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prepas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matiere_id');
            $table->longText('description');
            $table->string('className');
            $table->string('icon');
            $table->date('start_at');
            $table->date('end_at');
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
        Schema::dropIfExists('prepas');
    }
}
