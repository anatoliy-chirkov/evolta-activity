<?php

declare(strict_types=1);

namespace App\Activity\Models;

use App\SharedKernel\Models\EloquentUuid;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\UuidInterface;

/**
 * @property-read UuidInterface $id
 * @property-read UuidInterface $project_id
 * @property-read string $url
 * @property-read CarbonInterface $date
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 */
final class Activity extends Model
{
    use EloquentUuid;

    protected $table = 'activities';
    protected $fillable = ['id', 'project_id', 'url', 'date'];
    protected $guarded = ['id', 'project_id', 'url', 'date'];

    public static function log(LogAction $action): void
    {
        $activity = new self([
            'id' => $action->id,
            'project_id' => $action->projectId,
            'url' => $action->url,
            'date' => $action->date,
        ]);

        $activity->save();
    }
}
