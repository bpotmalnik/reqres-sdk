<?php

namespace Bpotmalnik\ReqresSdk\Resources\Users\Requests;

use Bpotmalnik\ReqresSdk\Resources\Users\Data\CreateUser;
use Bpotmalnik\ReqresSdk\Resources\Users\Data\User;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateUserRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        public CreateUser $createUser
    ) {

    }

    public function resolveEndpoint(): string
    {
        return 'users';
    }

    protected function defaultBody(): array
    {
        return [
            'name' => $this->createUser->name,
            'job' => $this->createUser->job,
        ];
    }

    public function createDtoFromResponse(Response $response): User
    {
        return new User(
            id: $response->json('id')
        );
    }
}
