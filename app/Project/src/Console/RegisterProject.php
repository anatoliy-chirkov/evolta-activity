<?php

declare(strict_types=1);

namespace App\Project\Console;

use App\Project\Models\Project;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

final class RegisterProject extends Command
{
    protected $signature = 'project:register {name}';
    protected $description = 'Register client project and generating Bearer token for him.';

    public function handle(): void
    {
        $name = $this->argument('name');

        try {
            $project = Project::register(Uuid::uuid4(), $name);
            $token = $project->generateToken();

            $this->info(sprintf(
                'Project has been registered. Copy and save Bearer token:%s%s',
                PHP_EOL,
                $token
            ));
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
