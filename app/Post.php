<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

		protected $guarded = ['id'];

		protected $with = ['owner', 'categories'];

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

		public function scopeActivated($query)
		{
				return $query->where('activated', 1);
		}

    public function activate()
    {
        $this->update(['activated' => true]);
    }

    public function deactivate()
    {
        $this->update(['activated' => false]);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'ticket');
    }
}
