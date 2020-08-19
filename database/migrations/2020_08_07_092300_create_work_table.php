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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->date('working_day')->nullable();
            $table->tinyInteger('orders')->nullable();
            $table->tinyInteger('company_id')->nullable();
            $table->string('start_working')->nullable();
            $table->string('end_working')->nullable();
            $table->float('break')->nullable();
            $table->string('working_account')->nullable();
            $table->string('location')->nullable();
            $table->tinyInteger('driver_id');
            $table->float('wetter_temp');
            $table->text('wetter_main');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

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
