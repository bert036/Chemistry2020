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
            $table->string('facebook_login', 127);
			
            $table->string('name', 127);
			$table->string('patronymic', 127);
			$table->string('surname', 127);
			
			$table->string('description', 127)->nullable();
			
			$table->primary('facebook_login');
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
