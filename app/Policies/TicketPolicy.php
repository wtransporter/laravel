<?php

namespace App\Policies;

use App\Ticket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, Ticket $ticket)
    {
        return ($user->hasRole('moderator') || $user->is($ticket->owner));
    }

}
