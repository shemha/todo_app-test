<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use \Rutorika\Sortable\SortableTrait;

    // １対多(Userモデルを'1'としてTodoモデルを'多')のリレーションを追加
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // １対多(Goalモデルを'1'としてTodoモデルを'多')のリレーションを追加
    public function goal()
    {
        return $this->belongsTo('App\Goal');
    }
    // 多対多(TodoモデルとTagモデルは互いに'多')のリレーションを追加
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
