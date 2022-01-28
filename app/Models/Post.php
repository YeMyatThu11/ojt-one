<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable =['title','content','author_id','public_post'];

    public function categories(){
        return $this->belongsToMany(Category::class,'post_categories');
    }
    public function user(){
        return $this->belongsTo(User::class,'author_id');
    }
}
