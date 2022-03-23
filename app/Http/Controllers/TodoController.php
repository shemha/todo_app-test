<?php

namespace App\Http\Controllers;

use App\Todo;
// 設定したGoalモデルとのリレーションを使用
use App\Goal;
use Illuminate\Http\Request;
// ログインしているユーザーのTodoのみをレスポンスとして返す
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Goal $goal)
    {
        // ASCの順に並び替えて取得
        $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのTodoをJSON形式で送信
        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Goal $goal)
    {
        // 新しいTodoモデルのレコードを作成
        $todo = new Todo();
        // 受け取ったレスポンスから'content'を取得し、Todoモデルのcontentカラムに代入
        $todo->content = request('content');
        // 投稿者のidを取得し、Todoモデルのuser_idカラムに代入
        $todo->user_id = Auth::id();
        // Goalモデルのidカラムにある情報を取得し、Todoモデルのgoal_idカラムに代入
        $todo->goal_id = $goal->id;
        // 受け取ったレスポンスから'position'を取得し、Todoモデルのpositionカラムに代入
        $todo->position = request('position');
        // Todoモデルのdoneカラムに'false'を代入
        $todo->done = false;
        // Todoモデルを保存
        $todo->save();
        // ASCの順に並び替える
        $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのTodoをJSON形式で送信
        return response()->json($todos);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal, Todo $todo)
    {
        // 受け取ったレスポンスから'content'を取得し、Todoモデルのcontentカラムを上書き
        $todo->content = request('content');
        // 投稿者のidを取得し、Todoモデルのuser_idカラムを上書き
        $todo->user_id = Auth::id();
        // Goalモデルのidカラムにある情報を取得し、Todoモデルのgoal_idカラムを上書き
        $todo->goal_id = $goal->id;
        // 受け取ったレスポンスから'position'を取得し、Todoモデルのpositionカラムを上書き
        $todo->position = request('position');
        // 受け取ったレスポンスから'done'を取得し、Todoモデルのdoneカラムを上書き
        $todo->done = (bool) request('done');
        // Todoモデルを保存
        $todo->save();
        // ASCの順に並び替える
        $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのTodoをJSON形式で送信
        return response()->json($todos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Goal $goal,Todo $todo)
    {
        // 指定したTodoモデルのレコードを削除
        $todo->delete();
        // ASCの順に並び替える
        $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
        // responseヘルパー関数でアクションからレスポンスを返す
        // ユーザーが作成したすべてのTodoをJSON形式で送信
        return response()->json($todos);
    }

    // Todoを並び替えられるsortアクションを実装
    public function sort(Request $request, Goal $goal, Todo $todo)
    {
        $exchangeTodo = Todo::where('position', request('sortId'))->first();
        $lastTodo = Todo::where('position', request('sortId'))->latest('position')->first();

        if (request('sortId') == 0) {
            $todo->moveBefore($exchangeTodo);
        } else if (request('sortId') - 1 == $lastTodo->position) {
            $todo->moveAfter($exchangeTodo);
        } else {
            $todo->moveAfter($exchangeTodo);
        }

        $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();

        return response()->json($todos);
    }
}
