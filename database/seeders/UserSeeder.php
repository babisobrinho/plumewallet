<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Enums\RoleType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::unsetEventDispatcher();

        // Create admin user
        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
        ]);

        $adminUser->assignRole('admin');

        // Get or create the Staff Team (admin is the owner]
        $staffTeam = $adminUser->ownedTeams()->save(Team::forceCreate([
            'user_id' => $adminUser->id,
            'name' => 'Staff Team',
            'personal_team' => true,
        ]));

        // Add admin to Staff Team
        $adminUser->teams()->attach($staffTeam, ['role' => 'admin']);

        // Get staff and client roles
        $staffRoles = Role::where('type', RoleType::STAFF->value)->get();
        $clientRoles = Role::where('type', RoleType::CLIENT->value)->get();

        // Create staff users (without personal teams, assigned to Staff Team)
        $staffUsers = User::factory()->count(10)->create();

        foreach ($staffUsers as $staffUser) {
            // Assign random staff role
            $randomStaffRole = $staffRoles->random();
            $staffUser->assignRole($randomStaffRole->name);

            // Add to Staff Team with appropriate Jetstream team role
            $jetstreamRole = $this->getJetstreamRoleForStaff($randomStaffRole->name);
            $staffUser->teams()->attach($staffTeam, ['role' => $jetstreamRole]);
        }

        // Create client users (with personal teams)
        $clientUsers = User::factory()->count(10)->create();

        foreach ($clientUsers as $clientUser) {
            // Create personal team for client
            $clientUser->ownedTeams()->save(Team::forceCreate([
                'user_id' => $clientUser->id,
                'name' => explode('@', $clientUser->email)[0] . "'s Team",
                'personal_team' => true,
            ]));

            // Assign random client role
            $randomClientRole = $clientRoles->random();
            $clientUser->assignRole($randomClientRole->name);
        }

        $this->command->info('Users created successfully with proper team assignments.');
    }

    /**
     * Map Spatie staff roles to Jetstream team roles
     */
    private function getJetstreamRoleForStaff(string $staffRole): string
    {
        return match($staffRole) {
            'admin' => 'admin',
            default => 'viewer'
        };
    }
}
