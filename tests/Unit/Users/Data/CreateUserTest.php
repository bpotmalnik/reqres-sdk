<?php

use Bpotmalnik\ReqresSdk\Resources\Users\Data\CreateUser;

it('can create user object', function () {
    $user = new CreateUser(
        name: 'test name',
        job: 'test job'
    );

    expect($user)
        ->toHaveProperties([
            'name' => 'test name',
            'job' => 'test job',
        ]);
});

it('can create user object from array', function () {
    $user = CreateUser::fromArray([
        'name' => 'test name',
        'job' => 'test job',
    ]);

    expect($user)
        ->toHaveProperties([
            'name' => 'test name',
            'job' => 'test job',
        ]);
});

it('is json serializable', function () {
    $user = CreateUser::fromArray([
        'name' => 'test name',
        'job' => 'test job',
    ]);

    expect(json_encode($user))
        ->toBe('{"name":"test name","job":"test job"}');
});
