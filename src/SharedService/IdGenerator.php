<?php

declare(strict_types=1);

namespace NtauhLabs\SharedService;


use Ramsey\Uuid\Uuid;

class IdGenerator
{

    /**
     * @return string
     */
    public function generate(): string {
        return Uuid::uuid4()->toString();
    }
}
