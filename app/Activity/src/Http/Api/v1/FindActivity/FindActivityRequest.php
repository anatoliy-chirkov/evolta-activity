<?php

declare(strict_types=1);

namespace App\Activity\Http\Api\v1\FindActivity;

use App\SharedKernel\Http\Requests\AuthenticatedFormRequest;

final class FindActivityRequest extends AuthenticatedFormRequest
{
    public function rules(): array
    {
        return [
            'limit' => 'int|required',
            'offset' => 'int|required'
        ];
    }

    public function getLimit(): int
    {
        return $this->request->getInt('limit');
    }

    public function getOffset(): int
    {
        return $this->request->getInt('offset');
    }
}
