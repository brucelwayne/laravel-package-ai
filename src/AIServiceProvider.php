<?php

namespace Brucelwayne\AI;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Mallria\Shop\Models\ExternalPostModel;

class AIServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->bootMigrations();
        $this->bootRelationMaps();
    }

    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function bootRelationMaps()
    {
        Relation::enforceMorphMap([
            ExternalPostModel::TABLE => ExternalPostModel::class,
        ]);
    }
}
