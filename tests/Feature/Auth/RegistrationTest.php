<?php

test('new users can register', function () {
    $response = $this->post('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'role' => 'fighter',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertNoContent();
});
