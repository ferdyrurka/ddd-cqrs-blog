<?php
declare(strict_types=1);

namespace PHPExtension\src\Uuid;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

class Uuid
{
    private UuidInterface $uuid;

    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function createUuid(): self
    {
        return new self(RamseyUuid::uuid4());
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }
}
