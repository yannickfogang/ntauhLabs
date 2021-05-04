<?php

declare(strict_types=1);

namespace Tests\Unit\_Mock\SharedService;


use NtauhLabs\SharedService\IdGenerator;

class IdGeneratorMock extends IdGenerator
{

    private int $id = 0;
    private string $lastId;

    public function generate(): string
    {
        $this->lastId   =   (string) ++$this->id;
        return $this->lastId;
    }

    public function getLastId(): string {
        return $this->lastId;
    }
}
