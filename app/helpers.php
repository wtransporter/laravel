<?php

function currentUser()
{
    return auth()->user();
}

function formatedDate($date)
{
	return date_format($date, 'd.m.Y H:i:s');
}

function hlString($string)
{
	return preg_replace("#```(.+?)(.+?)\```#is", "<pre><code>$2</code></pre>", $string);
}

function isModerator()
{
	$isModerator = false;

	if(Auth::check()){
		foreach(Auth::user()->roles as $role){
			if($role->name == 'moderator'){
				$isModerator = true;
				break;
			}
		}
	}

	return $isModerator;
}