<?php

declare(strict_types=1);

namespace App\Project\Models;

final class ProjectAlreadyExist extends \Exception
{
    public function __construct(string $name)
    {
        parent::__construct(sprintf('Project with name "%s" already exist', $name));
    }
}
