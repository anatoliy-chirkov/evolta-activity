<?php

declare(strict_types=1);

namespace App\SharedKernel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class AuthenticatedFormRequest extends FormRequest
{
    final public function getProjectId(): UuidInterface
    {
        return Uuid::fromString($this->user()->id);
    }
}
