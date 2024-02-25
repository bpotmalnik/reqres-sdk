<?php

namespace Bpotmalnik\ReqresSdk\Resources\Users\Requests;

use Bpotmalnik\ReqresSdk\Resources\Users\Data\User;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GetUsersRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'users';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return array_map(function (array $song) {
            return User::fromArray($song);
        }, $response->json('data'));
    }
}
