<?php

declare(strict_types=1);

namespace App\Activity\Models;

use Ramsey\Uuid\UuidInterface;

interface ActivityReadStorage
{
    /**
     * @return ActivityReadModel[]
     */
    public function find(UuidInterface $projectId, int $limit, int $offset): array;

    public function urlCount(UuidInterface $projectId): int;
}
