<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateProjectsTable extends Migration
{
    public function up(): void
    {
        Schema::create('projects', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('name', 32);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
}
