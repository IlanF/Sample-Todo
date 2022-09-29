<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-project', function (User $user, Project $project) {
            return $user->id === $project->user_id;
        });
        Gate::define('access-task', function (User $user, Task $task) {
            return $user->id === $task->user_id;
        });
    }
}
