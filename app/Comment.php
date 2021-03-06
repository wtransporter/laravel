<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	
	protected $guarded = [];

    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function ticket()
    {
    //	return $this->belongsTo(Ticket::class, 'ticket_id');
        return $this->morphTo();
    }



}
