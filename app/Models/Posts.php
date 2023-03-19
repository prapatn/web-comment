<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = ['id','title', 'message','user_id'];

    protected $dates = ['created_at','updated_at'];

    public function comments()
    {
        return $this->hasMany(Comments::class,'post_id','id')->whereNull('comment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
