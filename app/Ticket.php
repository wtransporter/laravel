<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	protected $guarded = [];

    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
    	return $this->hasMany(Comment::class, 'ticket_id');
    }

    public function addComment($content)
    {
        return $this->comments()->create($content);
    }

    public function path()
    {
    	return '/tickets/'. $this->slug;
    }

    public function getRouteKeyName()
    {
        return 'slug'; //Mora i u Laravel 7 ! Laravel 6
    }
}
