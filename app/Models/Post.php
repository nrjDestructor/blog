<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id', 'user_id', 'image'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->with('user');
    }
    public function users(){
        return $this->belongsToMany(User::class, 'likes');
    }
}
