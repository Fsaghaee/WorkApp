<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoive', function (Blueprint $table) {
            $table->id();
            $table->date('payed_date');
            $table->string('status');
            $table->string('title');
            $table->string('slip_file_location');
            $table->tinyInteger('company_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoive');
    }
}
