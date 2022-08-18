<?php

it('can view the register page', function () {
    $this->get('/register')
        ->assertStatus(200)
        ->assertSee('Register');
});
