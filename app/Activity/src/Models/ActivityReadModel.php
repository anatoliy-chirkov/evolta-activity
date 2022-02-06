<?php

declare(strict_types=1);

namespace App\Activity\Models;

use Carbon\CarbonInterface;

final class ActivityReadModel
{
    public function __construct(
        public readonly string $url,
        public readonly int $visits,
        public readonly CarbonInterface $lastVisit
    ) {}
}
