<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_orm_search_query', function (Blueprint $table) {
			$table->increments('id');
            $table->string('facebook_login', 127);
			$table->unsignedInteger('self_position_id');
			$table->unsignedInteger('search_position_id');
			$table->unsignedInteger('event_id');
			$table->string('description', 127);
			$table->boolean('is_active')->default(true);
			
			$table->foreign('self_position_id')->references('id')->on('t_orm_position');
			$table->foreign('search_position_id')->references('id')->on('t_orm_position');
			$table->foreign('facebook_login')->references('facebook_login')->on('t_orm_account');
			$table->foreign('event_id')->references('id')->on('t_orm_event');			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_orm_search_query');
    }
}
