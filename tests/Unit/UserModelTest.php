<?php

it('can automatically lowercase username', function () {
    $user = \App\Models\User::factory()->create([
        'name' => 'JohnDoe',
    ]);
    expect($user->name)->toBe('johndoe');
});

it('can remove spaces in username', function () {
    $user = \App\Models\User::factory()->create([
        'name' => 'John Doe',
    ]);
    expect($user->name)->toBe('johndoe');
});

it('creates mqtt acl when creating factory', function () {
    $user = \App\Models\User::factory()->create([
        'name' => 'johndoe',
    ]);

    $acl = $user->mqtt_acl()->first();

    expect($acl->user_id)->toBe($user->id);
    expect($acl->topic)->toBe($user->name.'/'.$user->uuid.'/#');
});

it('modifies acl when changing username', function () {
    $user = \App\Models\User::factory()->create([
        'name' => 'johndoe',
    ]);

    $acl = $user->mqtt_acl()->first();

    expect($acl->user_id)->toBe($user->id);
    expect($acl->topic)->toBe($user->name.'/'.$user->uuid.'/#');

    $user->name = 'johndoe2';
    $user->save();

    $acl->refresh();

    expect($acl->topic)->toBe($user->name.'/'.$user->uuid.'/#');
});

it('can get wifidevices for user', function () {
    $user = \App\Models\User::factory()->create();
    $wifiDevices = \App\Models\WifiDevice::factory(2)->create([
        'user_id' => $user->id,
    ]);

    $user->refresh();

    foreach ($wifiDevices as $wifiDevice) {
        expect($wifiDevice->user_id)->toBe($user->id);
    }

    expect($user->wifiDevices()->get()->count())->toBe(2);

    expect($user->wifi_device_uuids)->toBe([
        ''.$wifiDevices[0]->uuid.'',
        ''.$wifiDevices[1]->uuid.'',
    ]);
});

it('can access filament', function () {
    $user = \App\Models\User::factory()->create();
    expect($user->canAccessFilament())->toBe(true);
});
