<?php

beforeEach(function () {
    $this->user1 = \App\Models\User::factory()->create([
        'name' => 'JohnDoe',
    ]);

    $this->user2 = \App\Models\User::factory()->create([
        'name' => 'JaneDoe2',
    ]);

    // Log in as the user
    $this->actingAs($this->user1);

    $this->wifiDevice = \App\Models\WifiDevice::factory()->create([
        'user_id' => $this->user1->id,
    ]);

    $this->actingAs($this->user2);

    $this->wifiDevice = \App\Models\WifiDevice::factory()->create([
        'user_id' => $this->user2->id,
    ]);

    $this->actingAs($this->user1);
});

it('can create a realtime battle', function () {
    $this->realtimeBattle = \App\Models\RealtimeBattle::factory()->create();

    expect($this->realtimeBattle->user_id)->toBe($this->user1->id);
});

it('can generate an invite code', function () {
    $invite_code = \App\Models\RealtimeBattle::invite_code();

    // Expect $invite_code to be 6 characters long
    expect(strlen($invite_code))->toBe(6);
});

it('can get the user of a realtime battle', function () {
    $this->realtimeBattle = \App\Models\RealtimeBattle::factory()->create();

    expect($this->realtimeBattle->user->id)->toBe($this->user1->id);
});

it('can regen a code if one is already used', function () {
    $realtimeBattle = \App\Models\RealtimeBattle::factory()->create([
        'invite_code' => '111111',
    ]);

    expect($realtimeBattle->invite_code)->toBe('111111');

    $realtimeBattle2 = \App\Models\RealtimeBattle::factory()->create([
        'invite_code' => '111111',
    ]);

    expect($realtimeBattle2->invite_code)->not('111111');
});

it('can regen a code', function () {
    $realtimeBattle = \App\Models\RealtimeBattle::factory()->create([
        'invite_code' => '111111',
    ]);

    expect($realtimeBattle->invite_code)->toBe('111111');

    $gen_code = \App\Models\RealtimeBattle::invite_code('111111');

    expect($gen_code)->not('111111');
});

it('can generate its own invite_code if not provided', function () {
    $realtimeBattle = \App\Models\RealtimeBattle::factory()->create();

    expect(strlen($realtimeBattle->invite_code))->toBe(6);
});
