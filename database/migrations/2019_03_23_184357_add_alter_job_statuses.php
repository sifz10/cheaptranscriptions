<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlterJobStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transcribejobs', function (Blueprint $table) {
             DB::statement("ALTER TABLE transcribejobs CHANGE COLUMN status status ENUM('starting','inprogress','complete','failed','readyforhuma')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transcribejobs', function (Blueprint $table) {
            //
        });
    }
}
