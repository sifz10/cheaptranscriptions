<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToTranscribejobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transcribejobs', function (Blueprint $table) {
            $table->string('transactionid');
            $table->boolean('billingsuccessful');
            $table->string('striptxid');
            
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
