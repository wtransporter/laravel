<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $guarded = ['id'];

    public function owner()
    {
    	return $this->belongsTo(User::class);
    }

    public function path()
    {
    	return '/posts/'.$this->id;
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
