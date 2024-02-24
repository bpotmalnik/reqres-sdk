<?php

namespace Bpotmalnik\ReqresSdk\Requests\Users;

use Bpotmalnik\ReqresSdk\Data\User;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateUser extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        public string $name,
        public string $job
    ) {

    }

    public function resolveEndpoint(): string
    {
        return 'users';
    }

    protected function defaultBody(): array
    {
        return [
            'name' => $this->name,
            'job' => $this->job,
        ];
    }

    public function createDtoFromResponse(Response $response): User
    {
        return new User(
            id: $response->json('id')
        );
    }
}
