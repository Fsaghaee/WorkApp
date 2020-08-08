<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('family');
            $table->string('address');
            $table->string('working_account')->nullable();
            $table->string('working_email')->nullable()->unique();
            $table->string('insurance_number')->nullable();
            $table->date('birthday')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('password');
            $table->date('register_date');
            $table->date('unregister_date');
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
        Schema::dropIfExists('driver');
    }
}
