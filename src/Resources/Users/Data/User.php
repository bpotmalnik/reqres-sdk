<?php

namespace Bpotmalnik\ReqresSdk\Resources\Users\Data;

use JsonSerializable;

readonly class User implements JsonSerializable
{
    public function __construct(
        public ?string $id,
        public ?string $email = null,
        public ?string $first_name = null,
        public ?string $last_name = null,
        public ?string $avatar = null
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            id: $data['id'],
            email: $data['email'],
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            avatar: $data['avatar']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'avatar' => $this->avatar,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
