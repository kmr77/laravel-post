<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    // protected $table = 'plan_user'; //これを書いたことでテーブルの指定が中間テーブルになってしまっていた

    public function posts() {
        return $this->belongsToMany(Post::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
