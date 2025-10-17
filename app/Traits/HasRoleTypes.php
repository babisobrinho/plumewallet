<?php

namespace App\Traits;

trait HasRoleTypes
{
    /**
     * Check if user has a role with specific type
     */
    public function hasRoleType(string $type): bool
    {
        return $this->roles()->where('type', $type)->exists();
    }

    /**
     * Check if user has any of the given role types
     */
    public function hasAnyRoleType(array $types): bool
    {
        return $this->roles()->whereIn('type', $types)->exists();
    }
}
