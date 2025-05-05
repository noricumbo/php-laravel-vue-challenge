<?php

use App\Models\Team;

it('has a name attribute', function () {
    $team = new Team([
        'name' => 'Team 1',
        'color' => '#FFFFFF'
    ]);
    expect($team->name)->toBe('Team 1')
        ->and($team->color)->toBe('#FFFFFF');
});