<?php

namespace App\GraphQL\Mutations;

use App\Models\Ticket;

class DeleteTicket
{
    public function __invoke($root, array $args)
    {
        $id = $args['id'];
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return $id;
    }
}
