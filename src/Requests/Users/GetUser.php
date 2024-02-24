<?php

namespace Bpotmalnik\ReqresSdk\Requests\Users;

use Bpotmalnik\ReqresSdk\Data\User;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetUser extends Request
{
    protected Method $method = Method::GET;

    public function __construct(public readonly string $id)
    {
    }

    public function resolveEndpoint(): string
    {
        return "users/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): User
    {
        return User::fromArray($response->json('data'));
    }
}
