<?php

namespace Bpotmalnik\ReqresSdk\Resources\Users\Requests;

use Bpotmalnik\ReqresSdk\Resources\Users\Data\User;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetUserRequest extends Request
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
