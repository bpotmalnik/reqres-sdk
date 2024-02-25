<?php

use Bpotmalnik\ReqresSdk\ReqresConnector;
use Bpotmalnik\ReqresSdk\Resources\Users\Requests\GetUsersRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('can get users', function () {
    $mockClient = new MockClient([
        GetUsersRequest::class => MockResponse::fixture('all-users'),
    ]);

    $users = ReqresConnector::make()
        ->withMockClient($mockClient)
        ->users()
        ->all(
            perPage: 6,
            maxPages: 1
        );

    expect($users->first())
        ->toHaveProperties([
            'id' => 1,
            'email' => 'george.bluth@reqres.in',
            'first_name' => 'George',
            'last_name' => 'Bluth',
            'avatar' => 'https://reqres.in/img/faces/1-image.jpg',
        ])
        ->and($users)
        ->toMatchSnapshot();
});
