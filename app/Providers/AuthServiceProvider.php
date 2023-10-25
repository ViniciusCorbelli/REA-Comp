<?php

namespace App\Providers;

use App\Models\Favority;
use App\Models\Topic;
use App\Models\Repository;
use App\Models\User;
use App\Policies\FavorityPolicy;
use App\Policies\TopicPolicy;
use App\Policies\RepositoryPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Favority::class => FavorityPolicy::class,
        Topic::class => TopicPolicy::class,
        Repository::class => RepositoryPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();
    }
}
