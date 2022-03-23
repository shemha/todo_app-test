<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
            // テーブルラベル'content'は文書型のみを許可
            $table->text('content');
            // テーブルラベル'user_id'は整数型のみを許可
            $table->integer('user_id');
            // テーブルラベル'goal_id'は整数型のみを許可
            $table->integer('goal_id');
            // テーブルラベル'position'は整数型のみを許可
            $table->integer('position');
            // テーブルラベル'done'は論理型のみを許可、デフォルト値は'false'
            $table->boolean('done')->default(false);
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
        Schema::dropIfExists('todos');
    }
}
