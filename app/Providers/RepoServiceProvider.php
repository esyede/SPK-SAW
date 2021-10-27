<?php

namespace App\Providers;

use App\Repository\EvaluationRepository;
use App\Repository\EvaluationRepositoryImplement;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EvaluationRepository::class, EvaluationRepositoryImplement::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
