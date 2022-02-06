<?php

declare(strict_types=1);

namespace App\Project\Models;

use App\SharedKernel\Models\EloquentUuid;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\UuidInterface;

/**
 * @property-read UuidInterface $id
 * @property-read string $name
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 */
final class Project extends Model
{
    use EloquentUuid, HasApiTokens;

    protected $table = 'projects';
    protected $fillable = ['id', 'name'];
    protected $guarded = ['id', 'name'];

    /**
     * @throws ProjectAlreadyExist
     */
    public static function register(UuidInterface $id, string $name): self
    {
        if (self::query()->where('name', $name)->exists()) {
            throw new ProjectAlreadyExist($name);
        }

        $project = new self([
            'id' => $id,
            'name' => $name,
        ]);

        $project->save();

        return $project;
    }

    public function generateToken(): string
    {
        return explode('|', $this->createToken('default')->plainTextToken)[1];
    }
}
