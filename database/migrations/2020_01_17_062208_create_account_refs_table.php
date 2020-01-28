<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountRefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_orm_account_refs', function (Blueprint $table) {
            $table->increments('id');
			$table->bigInteger('account_id')->unsigned();
            $table->string('reference', 127);			
			$table->boolean('is_telegram');
			$table->boolean('is_active')->default(true);
			$table->foreign('account_id')->references('id')->on('t_orm_account');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_orm_account_refs');
    }
}
