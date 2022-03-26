<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoTag extends Model
{
    // １対多(Userモデルを'1'としてTagモデルを'多')のリレーションを追加
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // 多対多(TodoモデルとTagモデルは互いに'多')のリレーションを追加
    public function todos()
    {
        return $this->belongsToMany('App\Todo');
    }
}
