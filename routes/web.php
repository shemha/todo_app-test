<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TODOアプリにアクセスした際に一番最初に表示されるページを指定
Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

// ユーザーがログイン済みかどうかを確認
// GoalのRESTfulなルーティングを実装
Route::resource("goals", "GoalController")->middleware('auth');

// ユーザーがログイン済みかどうかを確認
// goals.todosと記述することでネストされたRESTfulなルーティングを実装
Route::resource("goals.todos", "TodoController")->middleware('auth');

// ユーザーがログイン済みかどうかを確認
// 作成したTodoを並び替える処理を行うルーティング
Route::post('/goals/{goal}/todos/{todo}/sort', 'TodoController@sort')->middleware('auth');

Auth::routes();