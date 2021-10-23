<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranscribejobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcribejobs', function (Blueprint $table) {
      $table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->string('soundfilename');
			$table->string('accuracy');
			$table->string('comments');
			$table->enum('status', ['starting', 'inprogress', 'complete']);

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
        Schema::dropIfExists('transcribejobs');
    }
}
