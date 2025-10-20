<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\CategoryGroup;
use App\Models\Team;
use Illuminate\Database\Seeder;

class CategoryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get client teams (teams owned by users with client roles)
        $clientTeams = Team::whereHas('owner', function ($query) {
            $query->whereHas('roles', function ($roleQuery) {
                $roleQuery->where('type', RoleType::CLIENT->value);
            });
        })->get();

        if ($clientTeams->isEmpty()) {
            $this->command->warn('No client teams found. Please run UserSeeder first to create client users with personal teams.');
            return;
        }

        $defaultGroups = [
            'Credit Card Payments',
            'Essential Expenses',
            'Non-Essential Expenses',
            'Income',
            'Savings & Investments',
            'Debt Payments',
        ];

        $groupsCreated = 0;

        foreach ($clientTeams as $team) {
            $this->command->info("Creating category groups for client team: {$team->name} (Owner: {$team->owner->name})");

            foreach ($defaultGroups as $groupName) {
                // Check if group already exists for this team
                $existingGroup = CategoryGroup::where('team_id', $team->id)
                    ->where('name', $groupName)
                    ->first();

                if (!$existingGroup) {
                    CategoryGroup::create([
                        'team_id' => $team->id,
                        'name' => $groupName,
                        'is_hidden' => false,
                    ]);

                    $groupsCreated++;
                }
            }

            $this->command->info("  - Created/verified category groups for team: {$team->name}");
        }

        $this->command->info("Category groups seeded successfully. Created/verified {$groupsCreated} groups.");
    }
}
