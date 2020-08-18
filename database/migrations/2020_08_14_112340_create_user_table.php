<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
                        $table->id();
                        $table->string('name');
                        $table->string('family');
                        $table->string('bank_account');
                        $table->string('ATU_number')->nullable();
                        $table->string('address');
                        $table->string('tell');
                        $table->string('email');
                        $table->string('password');
                        $table->string('remember_token')->nullable();
                        $table->timestamp('updated_at')->useCurrent();
                        $table->timestamp('created_at')->useCurrent();
                        $table->string('working_email')->nullable()->unique();
                        $table->string('insurance_number')->nullable();
                        $table->date('birthday')->nullable();
                        $table->string('payment_method')->nullable();
                        $table->date('register_date')->nullable();
                        $table->date('unregister_date')->nullable();
                        $table->tinyInteger('company_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
