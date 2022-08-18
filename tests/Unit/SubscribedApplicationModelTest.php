<?php

beforeEach(function () {
    $this->user = \App\Models\User::factory()->create([
        'name' => 'JohnDoe',
    ]);

    // Log in as the user
    $this->actingAs($this->user);

    $this->wifiDevice = \App\Models\WifiDevice::factory()->create([
        'user_id' => $this->user->id,
    ]);

    $this->application = \App\Models\Application::factory()->create();

    $this->subscribedApplication = \App\Models\SubscribedApplication::factory()->create([
        'user_id' => $this->user->id,
        'application_uuid' => $this->application->uuid,
    ]);
});

it('can make a subscribed application exclusive', function () {
    expect($this->subscribedApplication->is_exclusive)->toBe(false);

    $this->subscribedApplication->makeExclusive();

    expect($this->subscribedApplication->is_exclusive)->toBe(true);
});

it('can make a subscribed application nonexclusive', function () {
    expect($this->subscribedApplication->is_exclusive)->toBe(false);

    $this->subscribedApplication->makeExclusive();

    expect($this->subscribedApplication->is_exclusive)->toBe(true);

    $this->subscribedApplication->makeNotExclusive();

    expect($this->subscribedApplication->is_exclusive)->toBe(false);
});

it('can check for related user', function () {
    expect($this->subscribedApplication->user->id)->toBe($this->user->id);
});

it('can check for related app(lication)', function () {
    expect($this->subscribedApplication->app->id)->toBe($this->application->id);
});
