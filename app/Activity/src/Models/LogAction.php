<?php

declare(strict_types=1);

namespace App\Activity\Models;

use Carbon\CarbonInterface;
use Ramsey\Uuid\UuidInterface;

final class LogAction
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly UuidInterface $projectId,
        public readonly string $url,
        public readonly CarbonInterface $date
    ) {}
}
