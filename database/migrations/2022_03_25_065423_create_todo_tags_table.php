<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // 新しいテーブル、カラム、インデックスをデータベースに追加する
    public function up()
    {
        // ファサード(複雑なシステム内部の概念を単純化し隠蔽するインターフェース)を継承したSchemaクラスでテーブルを作成
        // tableメソッドの第一引数でテーブル名'tag_todo'を第二引数で新しいテーブル定義を行うクロージャを指定
        Schema::create('tag_todo', function (Blueprint $table) {
            $table->bigIncrements('id');
            // テーブルラベル'todo_id'は整数型のみを許可
            $table->integer('todo_id');
            // テーブルラベル'tag_id'は整数型のみを許可
            $table->integer('tag_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    // upメソッドが行った操作を元に戻す(追加したテーブル、カラム、インデックスをデータベースから削除する)
    public function down()
    {
        // ファサード(複雑なシステム内部の概念を単純化し隠蔽するインターフェース)を継承したSchemaクラスでテーブル操作
        // tableメソッドの第一引数でテーブル名'todo_tags'を第二引数で新しいテーブル定義を行うクロージャを指定
        Schema::table('todo_tags', function (Blueprint $table) {
            // dropColumnメソッドで実引数に指定したカラムを削除
            $table->dropColumn('todo_id');
            $table->dropColumn('tag_id');
            // 別解
            // $table->dropColumn(['todo_id', 'tag_id']);
        });
    }
}
