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

    /**
     * Post path using slug
     */
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

    /**
     * Scope a query to only include active posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivated($query)
    {
        return $query->where('activated', 1);
    }

    /**
     * Activate post
     */
    public function activate()
    {
        $this->update(['activated' => true]);
    }

    /**
     * Deactivate post
     */
    public function deactivate()
    {
        $this->update(['activated' => false]);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'ticket');
    }

    /**
     * Scope a query to only include posts that match $search in title and content.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $search keyword for searching
     * @param int $take
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserSearch($query, string $search, $take = 10)
    {
        return $query->where('title', 'LIKE', $search)
    		->orWhere('content', 'LIKE', $search)
    		->paginate($take);
    }

}
