<?php

namespace Bpotmalnik\ReqresSdk\Data;

readonly class User
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
}
