<?php

use App\Models\Project;
use App\Models\User;

test('dashboard shows only the authenticated user\'s projects', function () {
    $me = User::factory()->create();
    $other = User::factory()->create();

    $mine = Project::factory()->for($me)->create(['judul' => 'My Project']);
    $theirs = Project::factory()->for($other)->create(['judul' => 'Their Project']);

    $response = $this->actingAs($me)->get('/dashboard');

    $response->assertOk();
    $response->assertSee('My Project');
    $response->assertDontSee('Their Project');
});

test('dashboard lists projects newest first', function () {
    $user = User::factory()->create();

    $old = Project::factory()->for($user)->create([
        'judul' => 'Old Project',
        'created_at' => now()->subDays(3),
    ]);
    $new = Project::factory()->for($user)->create([
        'judul' => 'New Project',
        'created_at' => now(),
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertSeeInOrder(['New Project', 'Old Project']);
});
