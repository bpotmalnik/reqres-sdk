<?php

use Bpotmalnik\ReqresSdk\Data\User;

it('can create user object', function () {
    $user = new User(
        id: '1',
        email: 'test@email.com',
        first_name: 'Test',
        last_name: 'User',
        avatar: 'https://google.com'
    );

    expect($user)
        ->toHaveProperties([
            'id' => '1',
            'email' => 'test@email.com',
            'first_name' => 'Test',
            'last_name' => 'User',
            'avatar' => 'https://google.com',
        ]);
});

it('can create user object from array', function () {
    $user = User::fromArray([
        'id' => '1',
        'email' => 'test@email.com',
        'first_name' => 'Test',
        'last_name' => 'User',
        'avatar' => 'https://google.com',
    ]);

    expect($user)
        ->toHaveProperties([
            'id' => '1',
            'email' => 'test@email.com',
            'first_name' => 'Test',
            'last_name' => 'User',
            'avatar' => 'https://google.com',
        ]);
});

it('is json serializable', function () {
    $user = User::fromArray([
        'id' => '1',
        'email' => 'test@email.com',
        'first_name' => 'Test',
        'last_name' => 'User',
        'avatar' => 'https://google.com',
    ]);

    expect(json_encode($user))
        ->toBe('{"id":"1","email":"test@email.com","first_name":"Test","last_name":"User","avatar":"https:\/\/google.com"}');
});
