<?php

namespace App\Http\Controllers;

use App\Goal;
use Illuminate\Http\Request;
// ログインしているユーザーの投稿のみをレスポンスとして返す
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goals = Auth::user()->goals;

        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのGoalをJSON形式で送信
        return response()->json($goals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 新しいGoalモデルのレコードを作成
        $goal = new Goal();
        // 受け取ったレスポンスから'title'を取得し、Goalモデルのtitleカラムに代入
        $goal->title = request('title');
        // 投稿者のidを取得し、Goalモデルのuser_idカラムに代入
        $goal->user_id = Auth::id();
        // Goalモデルを保存
        $goal->save();

        $goals = Auth::user()->goals;

        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのGoalをJSON形式で送信
        return response()->json($goals);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        // 受け取ったレスポンスから'title'を抽出し、Goalモデルのtitleカラムに上書き
        $goal->title = request('title');
        // 投稿者のidを取得し、Goalモデルのuser_idカラムに上書き
        $goal->user_id = Auth::id();
        // Goalモデルを保存
        $goal->save();

        $goals = Auth::user()->goals;

        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのGoalをJSON形式で送信
        return response()->json($goals);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        // 指定したGoalモデルのレコードを削除
        $goal->delete();

        $goals = Auth::user()->goals;

        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのGoalをJSON形式で送信
        return response()->json($goals);
    }
}
