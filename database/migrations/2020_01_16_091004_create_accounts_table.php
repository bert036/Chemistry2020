<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_orm_account', function (Blueprint $table) {
			$table->bigInteger('id')->unsigned();
			
            $table->string('facebook_login', 127);
			
            $table->string('first_name', 127);
			$table->string('middle_name', 127);
			$table->string('last_name', 127);
			
			$table->string('description', 127)->nullable();
			
			$table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_orm_account');
    }
}
