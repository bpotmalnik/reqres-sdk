<?php

use Bpotmalnik\ReqresSdk\ReqresConnector;
use Bpotmalnik\ReqresSdk\Requests\Users\CreateUser;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('can create user', function () {
    $mockClient = new MockClient([
        CreateUser::class => MockResponse::fixture('create-user'),
    ]);

    $user = (new ReqresConnector)
        ->withMockClient($mockClient)
        ->users()
        ->create('test name', 'test job')
        ->dto();

    expect($user)
        ->toHaveProperties([
            'id' => 893,
        ]);
});
