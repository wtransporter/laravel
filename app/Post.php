<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $guarded = ['id'];

    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function path()
    {
    	return '/posts/'.$this->slug;
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function activate()
    {
        $this->update(['activated' => true]);
    }

    public function deactivate()
    {
        $this->update(['activated' => false]);
    }
}
