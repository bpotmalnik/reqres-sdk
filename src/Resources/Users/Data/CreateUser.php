<?php

namespace Bpotmalnik\ReqresSdk\Resources\Users\Data;

use JsonSerializable;

readonly class CreateUser implements JsonSerializable
{
    public function __construct(
        public string $name,
        public string $job
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            name: $data['name'],
            job: $data['job'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'job' => $this->job,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
