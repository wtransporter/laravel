<?php

function currentUser()
{
    return auth()->user();
}

function formatedDate($date)
{
	return date_format($date, 'd.m.Y H:i:s');
}
