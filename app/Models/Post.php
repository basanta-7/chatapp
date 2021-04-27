<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'excerpt', 'status', 'image', 'user_id'];

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id');
    }
}