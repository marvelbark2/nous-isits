<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteAllsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_alls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('note');
            $table->string('element');
            $table->string('type');
            $table->string('date');
            $table->string('student_id');
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
        Schema::dropIfExists('note_alls');
    }
}
