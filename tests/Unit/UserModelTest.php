<?php

use App\Models\User;

it('has a name attribute', function () {
    $user = new User([
        'name' => 'User name',
        'email' => 'example@example.com',
    ]);
    expect($user->name)->toBe('User name')
        ->and($user->email)->toBe('example@example.com');
});
