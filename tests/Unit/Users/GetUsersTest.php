<?php

use Bpotmalnik\ReqresSdk\ReqresConnector;
use Bpotmalnik\ReqresSdk\Requests\Users\GetUsers;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('can get users', function () {
    $mockClient = new MockClient([
        GetUsers::class => MockResponse::fixture('users'),
    ]);

    $users = (new ReqresConnector)
        ->withMockClient($mockClient)
        ->users()
        ->all();

    $users->setPerPageLimit(1);
    $users->setMaxPages(1);

    expect($users->collect()->first())
        ->toHaveProperties([
            'id' => 1,
            'email' => 'george.bluth@reqres.in',
            'first_name' => 'George',
            'last_name' => 'Bluth',
            'avatar' => 'https://reqres.in/img/faces/1-image.jpg',
        ]);
});
