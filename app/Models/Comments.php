<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['id','message','user_id', 'post_id', 'comment_id',];


    public function post()
    {
        return $this->belongsTo(Posts::class,'post_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comments::class,'comment_id');
    }
    public function comments()
    {
        return $this->hasMany(Comments::class,'comment_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
