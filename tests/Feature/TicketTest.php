<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetTickets()
    {
        // Simula una consulta a la ruta /graphql utilizando la consulta tickets
        $response = $this->postJson('/graphql', [
            'query' => 'query {
                tickets {
                    id
                    user
                    ticket
                    createdAt
                    updatedAt
                    status
                }
            }'
        ]);

        $response->assertStatus(200);
        // Realiza las comprobaciones necesarias en la respuesta de la consulta
        // Puedes verificar los campos devueltos, la estructura del resultado, etc.
    }

    public function testGetTicket()
    {
        // Simula una consulta a la ruta /graphql utilizando la consulta ticket con un ID válido
        $response = $this->postJson('/graphql', [
            'query' => 'query ($id: ID!) {
                ticket(id: $id) {
                    id
                    user
                    ticket
                    createdAt
                    updatedAt
                    status
                }
            }',
            'variables' => [
                'id' => 1, // Reemplaza con un ID válido existente en tu base de datos
            ],
        ]);

        $response->assertStatus(200);
        // Realiza las comprobaciones necesarias en la respuesta de la consulta
        // Puedes verificar los campos devueltos, la estructura del resultado, etc.
    }

    public function testCreateTicket()
    {
        // Simula una mutación para crear un nuevo ticket
        $response = $this->postJson('/graphql', [
            'query' => 'mutation ($user: String!, $status: String!, $ticket: String!) {
                createTicket(user: $user, status: $status, ticket: $ticket) {
                    id
                    user
                    ticket
                    createdAt
                    updatedAt
                    status
                }
            }',
            'variables' => [
                'user' => 'John Doe',
                'status' => 'Open',
                'ticket' => 'My new ticket',
            ],
        ]);

        $response->assertStatus(200);
        // Realiza las comprobaciones necesarias en la respuesta de la mutación
        // Puedes verificar los campos devueltos, la estructura del resultado, etc.
    }

    public function testUpdateTicket()
    {
        // Simula una mutación para actualizar un ticket existente
        $response = $this->postJson('/graphql', [
            'query' => 'mutation ($id: ID!, $user: String!, $status: String!, $ticket: String!) {
                updateTicket(id: $id, user: $user, status: $status, ticket: $ticket) {
                    id
                    user
                    ticket
                    createdAt
                    updatedAt
                    status
                }
            }',
            'variables' => [
                'id' => 1, // Reemplaza con un ID válido existente en tu base de datos
                'user' => 'John Doe',
                'status' => 'Closed',
                'ticket' => 'Updated ticket',
            ],
        ]);

        $response->assertStatus(200);
        // Realiza las comprobaciones necesarias en la respuesta de la mutación
        // Puedes verificar los campos devueltos, la estructura del resultado, etc.
    }

    public function testDeleteTicket()
    {
        // Simula una mutación para eliminar un ticket existente
        $response = $this->postJson('/graphql', [
            'query' => 'mutation ($id: ID!) {
                deleteTicket(id: $id)
            }',
            'variables' => [
                'id' => 1, // Reemplaza con un ID válido existente en tu base de datos
            ],
        ]);

        $response->assertStatus(200);
        // Realiza las comprobaciones necesarias en la respuesta de la mutación
        // Puedes verificar el ID eliminado o realizar consultas adicionales para confirmar la eliminación
    }
}
