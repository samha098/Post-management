<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function categories() {
        return $this->belongsToMany(Category::class);
    }
   
}
