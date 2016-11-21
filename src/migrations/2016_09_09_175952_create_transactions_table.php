<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('person_id');
            $table->char('personType', 2);
            $table->string('transactionID');
            $table->string('sessionID', 32);
            $table->string('returnCode', 30);
            $table->string('trazabilityCode', 40);
            $table->string('transactionCycle');
            $table->string('bankCurrency', 3);
            $table->float('bankFactor');
            $table->string('bankURL', 255);
            $table->integer('responseCode');
            $table->string('responseReasonCode', 3);
            $table->string('responseReasonText', 255);
            
            $table->string('returnCode', 30);
            $table->string('transactionState', 20);
            $table->string('reference', 32);
            $table->double('amount');
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
        Schema::dropIfExists('transactions');
    }
}
