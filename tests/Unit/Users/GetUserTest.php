<?php

use Bpotmalnik\ReqresSdk\ReqresConnector;
use Bpotmalnik\ReqresSdk\Requests\Users\GetUser;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('can get user', function () {
    $mockClient = new MockClient([
        GetUser::class => MockResponse::fixture('user'),
    ]);

    $user = (new ReqresConnector)
        ->withMockClient($mockClient)
        ->users()
        ->get('1')
        ->dto();

    expect($user)
        ->toHaveProperties([
            'id' => 1,
            'email' => 'george.bluth@reqres.in',
            'first_name' => 'George',
            'last_name' => 'Bluth',
            'avatar' => 'https://reqres.in/img/faces/1-image.jpg',
        ]);
});
