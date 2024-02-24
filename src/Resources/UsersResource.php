<?php

namespace Bpotmalnik\ReqresSdk\Resources;

use Bpotmalnik\ReqresSdk\Requests\Users\CreateUser;
use Bpotmalnik\ReqresSdk\Requests\Users\GetUser;
use Bpotmalnik\ReqresSdk\Requests\Users\GetUsers;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\PagedPaginator;

class UsersResource extends BaseResource
{
    public function all(): PagedPaginator
    {
        return $this->connector->paginate(new GetUsers);
    }

    public function get(string $id): Response
    {
        return $this->connector->send(new GetUser($id));
    }

    public function create(string $name, string $job): Response
    {
        return $this->connector->send(new CreateUser($name, $job));
    }
}
