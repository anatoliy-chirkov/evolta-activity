<?php

declare(strict_types=1);

namespace App\SharedKernel\Structs;

final class QueryResult
{
    public function __construct(
        public readonly int $total,
        public readonly array $items
    ) {}
}
