<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    // １対多(Userモデルを'1'としてGoalモデルを'多')のリレーションを追加
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // １対多(Goalモデルを'1'としてTodoモデルを'多')のリレーションを追加
    public function todos()
    {
        return $this->hasMany('App\Todo');
    }
}
