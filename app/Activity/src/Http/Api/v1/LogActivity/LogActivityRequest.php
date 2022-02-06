<?php

declare(strict_types=1);

namespace App\Activity\Http\Api\v1\LogActivity;

use App\SharedKernel\Http\Requests\AuthenticatedFormRequest;
use Carbon\Carbon;
use Carbon\CarbonInterface;

final class LogActivityRequest extends AuthenticatedFormRequest
{
    public function rules(): array
    {
        return [
            'url' => 'url|required',
            'date' => 'date|required'
        ];
    }

    public function getActivityUrl(): string
    {
        return $this->input('url');
    }

    public function getDate(): CarbonInterface
    {
        return new Carbon($this->input('date'));
    }
}
