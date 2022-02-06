<?php

declare(strict_types=1);

namespace App\Activity\Persistence;

use App\Activity\Models\ActivityReadModel;
use App\Activity\Models\ActivityReadStorage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\UuidInterface;

final class ActivityPdoRepository implements ActivityReadStorage
{
    /**
     * @return ActivityReadModel[]
     */
    public function find(UuidInterface $projectId, int $limit, int $offset): array
    {
        $query = DB::connection()->getPdo()->prepare(
            <<<SQL
                SELECT url, count(id) as visits, max(date) as last_visit 
                FROM activities
                WHERE project_id = :project_id
                GROUP BY url
                LIMIT :limit OFFSET :offset
            SQL
        );

        $query->execute([':project_id' => $projectId, ':limit' => $limit, ':offset' => $offset]);

        return array_map(
            fn (array $element): ActivityReadModel => new ActivityReadModel(
                $element['url'],
                $element['visits'],
                new Carbon($element['last_visit'])
            ),
            $query->fetchAll(\PDO::FETCH_ASSOC)
        );
    }

    public function urlCount(UuidInterface $projectId): int
    {
        $query = DB::connection()->getPdo()->prepare(
            <<<SQL
                SELECT count(DISTINCT url) FROM activities WHERE project_id = :project_id
            SQL
        );

        $query->execute([':project_id' => $projectId]);

        return $query->fetchColumn();
    }
}
