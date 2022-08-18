<?php

it('can view the login page', function () {
    $this->get('/login')
        ->assertStatus(200)
        ->assertSee('Login');
});
