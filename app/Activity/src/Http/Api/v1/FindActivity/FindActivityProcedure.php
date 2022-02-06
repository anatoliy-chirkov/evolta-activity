<?php

declare(strict_types=1);

namespace App\Activity\Http\Api\v1\FindActivity;

use App\Activity\Models\ActivityReadStorage;
use App\SharedKernel\Structs\QueryResult;
use Sajya\Server\Procedure;

final class FindActivityProcedure extends Procedure
{
    public static string $name = 'findActivity';

    public function findActivity(FindActivityRequest $request, ActivityReadStorage $storage): QueryResult
    {
        return new QueryResult(
            $storage->urlCount($request->getProjectId()),
            $storage->find(
                $request->getProjectId(),
                $request->getLimit(),
                $request->getOffset()
            )
        );
    }
}
