<?php

it('can populate user_id field', function () {
    $user = \App\Models\User::factory()->create([
        'name' => 'JohnDoe',
    ]);

    // Log in as the user
    $this->actingAs($user);

    // Use actingas $user to generate a wifidevice for the user
    $wifiDevice = \App\Models\WifiDevice::factory()->create();

    expect($wifiDevice->user_id)->toBe($user->id);
});

it('can get subscribedApplications', function () {
    $user = \App\Models\User::factory()->create([
        'name' => 'JohnDoe',
    ]);

    // Log in as the user
    $this->actingAs($user);

    $wifiDevice = \App\Models\WifiDevice::factory()->create([
        'user_id' => $user->id,
    ]);

    $application = \App\Models\Application::factory()->create();

    $subscribedApplication = \App\Models\SubscribedApplication::factory()->create([
        'user_id' => $user->id,
        'application_uuid' => $application->uuid,
    ]);

    expect($wifiDevice->subscribedApplications()->get()->count())->toBe(1);
});
