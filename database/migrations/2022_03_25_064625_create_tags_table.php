<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
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
        // createメソッドの第一引数でテーブル名'tags'を第二引数で新しいテーブル定義を行うクロージャを指定
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            // テーブルラベル'title'は文書型のみを許可
            $table->string('title');
            // テーブルラベル'user_id'は整数型のみを許可
            $table->integer('user_id');
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
        // tableメソッドの第一引数でテーブル名'tags'を第二引数で新しいテーブル定義を行うクロージャを指定
        Schema::table('tags', function (Blueprint $table) {
            // dropColumnメソッドで実引数に指定したカラムを削除
            $table->dropColumn('title');
            $table->dropColumn('user_id');
            // 別解
            // $table->dropColumn(['title', 'user_id']);
        });
    }
}
