<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work', function (Blueprint $table) {
            $table->id();
            $table->date('working_day')->nullable();
            $table->tinyInteger('orders')->nullable();
            $table->date('start_working')->nullable();
            $table->date('end_working')->nullable();
            $table->date('start_break')->nullable();
            $table->date('start_break')->nullable();
            $table->string('working_account')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work');
    }
}
