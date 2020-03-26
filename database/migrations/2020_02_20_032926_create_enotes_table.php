<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('element');
            $table->string('m_cc');
            $table->string('m_tp')->nullable();
            $table->string('m_ef');
            $table->string('r_cc');
            $table->string('r_tp')->nullable();
            $table->string('r_ef');
            $table->string('note');
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
        Schema::dropIfExists('enotes');
    }
}
