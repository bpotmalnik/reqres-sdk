<?php

use Bpotmalnik\ReqresSdk\ReqresConnector;
use Bpotmalnik\ReqresSdk\Resources\Users\Data\CreateUser;
use Bpotmalnik\ReqresSdk\Resources\Users\Requests\CreateUserRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('can create user', function () {
    $mockClient = new MockClient([
        CreateUserRequest::class => MockResponse::fixture('create-user'),
    ]);

    $user = ReqresConnector::make()
        ->withMockClient($mockClient)
        ->users()
        ->create(
            new CreateUser(
                name: 'test name',
                job: 'test job'
            )
        );

    expect($user)
        ->toHaveProperties([
            'id' => '591',
        ]);
});
