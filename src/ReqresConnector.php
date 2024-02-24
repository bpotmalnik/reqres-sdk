<?php

namespace Bpotmalnik\ReqresSdk;

use Bpotmalnik\ReqresSdk\Resources\UsersResource;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\PagedPaginator;

class ReqresConnector extends Connector implements HasPagination
{
    public function resolveBaseUrl(): string
    {
        return 'https://reqres.in/api/';
    }

    public function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function users(): UsersResource
    {
        return new UsersResource($this);
    }

    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator {
            protected function isLastPage(
                Response $response
            ): bool {
                return $response->json('page')
                    === $response->json('total_pages');
            }

            protected function getTotalPages(Response $response): int
            {
                return $response->json('total_pages');
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->dto();
            }
        };
    }
}
