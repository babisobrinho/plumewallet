<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        /* roles and their permissions */
        $roles = [
            'owner' => [
                'space:read',
                'space:update',
                'space:delete',
                'members:read',
                'members:invite',
                'members:update',
                'members:remove',
                'accounts:read',
                'accounts:create',
                'accounts:update',
                'accounts:delete',
                'category-groups:read',
                'category-groups:create',
                'category-groups:update',
                'category-groups:delete',
                'categories:read',
                'categories:create',
                'categories:update',
                'categories:delete',
                'payees:read',
                'payees:create',
                'payees:update',
                'payees:delete',
                'transactions:read',
                'transactions:create',
                'transactions:update',
                'transactions:delete',
            ],
            'admin' => [
                'space:read',
                'space:update',
                'members:read',
                'members:invite',
                'members:update',
                'members:remove',
                'accounts:read',
                'accounts:create',
                'accounts:update',
                'accounts:delete',
                'category-groups:read',
                'category-groups:create',
                'category-groups:update',
                'category-groups:delete',
                'categories:read',
                'categories:create',
                'categories:update',
                'categories:delete',
                'payees:read',
                'payees:create',
                'payees:update',
                'payees:delete',
                'transactions:read',
                'transactions:create',
                'transactions:update',
                'transactions:delete',
            ],
            'manager' => [
                'space:read',
                'members:read',
                'accounts:read',
                'accounts:create',
                'accounts:update',
                'accounts:delete',
                'category-groups:read',
                'category-groups:create',
                'category-groups:update',
                'category-groups:delete',
                'categories:read',
                'categories:create',
                'categories:update',
                'categories:delete',
                'payees:read',
                'payees:create',
                'payees:update',
                'payees:delete',
                'transactions:read',
                'transactions:create',
                'transactions:update',
                'transactions:delete',
            ],
            'contributor' => [
                'space:read',
                'accounts:read',
                'category-groups:read',
                'categories:read',
                'payees:read',
                'payees:create',
                'payees:update',
                'transactions:read',
                'transactions:create',
                'transactions:update',
            ],
            'viewer' => [
                'space:read',
                'accounts:read',
                'category-groups:read',
                'categories:read',
                'payees:read',
                'transactions:read',
            ],
        ];

        foreach ($roles as $key => $permissions) {
            Jetstream::role($key, __("teams.roles.names.{$key}"), $permissions)
                ->description(__("teams.roles.descriptions.{$key}"));
        }
    }
}
