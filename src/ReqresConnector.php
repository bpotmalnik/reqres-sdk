<?php

namespace Bpotmalnik\ReqresSdk;

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
            'Content-Type' => 'application/json',
        ];
    }

    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator
        {
            protected function isLastPage(
                Response $response
            ): bool {
                return $response->json('page')
                    === $response->json('total_pages');
            }

            protected function getPageItems(
                Response $response,
                Request $request
            ): array {
                return $response->json('data');
            }
        };
    }
}
