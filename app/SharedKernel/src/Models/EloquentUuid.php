<?php

declare(strict_types=1);

namespace App\SharedKernel\Models;

trait EloquentUuid
{
    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
