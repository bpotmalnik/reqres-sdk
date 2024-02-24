<?php

namespace Bpotmalnik\ReqresSdk\Resources;

use Bpotmalnik\ReqresSdk\Data\User;
use Bpotmalnik\ReqresSdk\Requests\Users\CreateUser;
use Bpotmalnik\ReqresSdk\Requests\Users\GetUser;
use Bpotmalnik\ReqresSdk\Requests\Users\GetUsers;
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
            ->paginate(new GetUsers)
            ->setPerPageLimit($perPage)
            ->setMaxPages($maxPages)
            ->setStartPage($startPage)
            ->collect();
    }

    public function get(string $id): User
    {
        return $this->connector->send(new GetUser($id))
            ->dto();
    }

    public function create(string $name, string $job): User
    {
        return $this->connector->send(new CreateUser($name, $job))
            ->dto();
    }
}
