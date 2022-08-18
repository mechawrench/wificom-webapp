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
});

it('can get get related user', function () {
    expect($this->application->user->id)->toBe($this->user->id);
});

it('can get get related subscribers', function () {
    // Subscribe the user to the application
    $this->subscribedApplication = \App\Models\SubscribedApplication::factory()->create([
        'user_id' => $this->user->id,
        'application_uuid' => $this->application->uuid,
    ]);

    expect($this->application->subscribers->count())->toBe(1);
});

it('can get get subscriber is subscribed', function () {
    // Subscribe the user to the application
    $this->subscribedApplication = \App\Models\SubscribedApplication::factory()->create([
        'user_id' => $this->user->id,
        'application_uuid' => $this->application->uuid,
    ]);

    expect($this->application->subscribed->id)->toBe($this->subscribedApplication->id);
});
