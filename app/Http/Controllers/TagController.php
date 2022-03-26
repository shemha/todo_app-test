<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 投稿者情報を取得し、user変数に代入
        $user = Auth::user();
        // Userモデルからtagsカラムを抽出しtags変数に代入
        $tags = $user->tags;
        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのTagをJSON形式で送信
        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 新しいTagモデルのレコードを作成
        $tag = new Tag();
        // 受け取ったレスポンスから'title'を取得し、Tagモデルのtitleカラムに代入
        $tag->title = request('title');
        // 投稿者のidを取得し、Tagモデルのuser_idカラムに代入
        $tag->user_id = Auth::id();
        // Tagモデルを保存
        $tag->save();

        // 投稿者情報を取得し、user変数に代入
        $user = Auth::user();

        // Userモデルからtagsカラムを抽出しtags変数に代入
        $tags = $user->tags;
        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのTagをJSON形式で送信
        return response()->json($tags);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        // 受け取ったレスポンスから'title'を取得し、Tagモデルのtitleカラムに上書き
        $tag->title = request('title');
        // 投稿者のidを取得し、Tagモデルのuser_idカラムに上書き
        $tag->user_id = Auth::id();
        // Tagモデルを保存
        $tag->save();

        // 投稿者情報を取得し、user変数に代入
        $user = Auth::user();

        // Userモデルからtagsカラムを抽出しtags変数に代入
        $tags = $user->tags;
        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのTagをJSON形式で送信
        return response()->json($tags);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tag $tag)
    {
        // 指定したTagモデルのレコードを削除
        $tag->delete();

        // 投稿者情報を取得し、user変数に代入
        $user = Auth::user();

        // Userモデルからtagsカラムを抽出しtags変数に代入
        $tags = $user->tags;
        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのTagをJSON形式で送信
        return response()->json($tags);
    }
}
