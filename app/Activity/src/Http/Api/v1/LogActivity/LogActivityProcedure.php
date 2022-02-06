<?php

declare(strict_types=1);

namespace App\Activity\Http\Api\v1\LogActivity;

use App\Activity\Models\Activity;
use App\Activity\Models\LogAction;
use Ramsey\Uuid\Uuid;
use Sajya\Server\Procedure;

final class LogActivityProcedure extends Procedure
{
    public static string $name = 'logActivity';

    public function logActivity(LogActivityRequest $request): void
    {
        Activity::log(
            new LogAction(
                Uuid::uuid4(),
                $request->getProjectId(),
                $request->getActivityUrl(),
                $request->getDate()
            )
        );
    }
}
