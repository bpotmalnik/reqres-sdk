<?php

namespace Bpotmalnik\ReqresSdk\Resources\Users;

use Bpotmalnik\ReqresSdk\Resources\Users\Data\CreateUser;
use Bpotmalnik\ReqresSdk\Resources\Users\Data\User;
use Bpotmalnik\ReqresSdk\Resources\Users\Requests\CreateUserRequest;
use Bpotmalnik\ReqresSdk\Resources\Users\Requests\GetUserRequest;
use Bpotmalnik\ReqresSdk\Resources\Users\Requests\GetUsersRequest;
use Illuminate\Support\LazyCollection;
use Saloon\Http\BaseResource;

class UsersResource extends BaseResource
{
    public function all(
        ?int $perPage = null,
        ?int $maxPages = null,
        ?int $startPage = 1,
    ): LazyCollection {
        return $this->connector
            ->paginate(new GetUsersRequest)
            ->setPerPageLimit($perPage)
            ->setMaxPages($maxPages)
            ->setStartPage($startPage)
            ->collect();
    }

    public function get(string $id): User
    {
        return $this->connector->send(new GetUserRequest($id))
            ->dto();
    }

    public function create(CreateUser $createUser): User
    {
        return $this->connector->send(new CreateUserRequest($createUser))
            ->dto();
    }
}
