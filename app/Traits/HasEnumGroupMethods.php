<?php

namespace App\Traits;

trait HasEnumGroupMethods
{
    /**
     * Define groups of enum cases (must be implemented by the enum)
     *
     * Expected format:
     * [
     *      'group_name' => [
     *          self::CASE1,
     *          self::CASE2,
     *      ],
     * ]
     *
     * @return array<string, array<self>>
     */
    public static function groups(): array
    {
        throw new \BadMethodCallException('The groups() method must be implemented by the enum class');
    }

    /**
     * Get all enum cases belonging to a specific group
     */
    public static function getGroup(string $groupName): array
    {
        return self::groups()[$groupName] ?? [];
    }

    /**
     * Check if the current enum case belongs to a specific group
     */
    public function belongsToGroup(string $groupName): bool
    {
        return in_array($this, self::getGroup($groupName));
    }

    /**
     * Get all group names that the current enum case belongs to
     */
    public function getGroups(): array
    {
        return array_keys(array_filter(self::groups(), function ($types) {
            return in_array($this, $types);
        }));
    }

    /**
     * Get translated labels for all defined groups
     */
    public static function groupLabels(): array
    {
        return array_reduce(array_keys(self::groups()), function ($carry, $groupName) {
            $carry[$groupName] = __('enum.groups.' . $groupName);
            return $carry;
        }, []);
    }

    /**
     * Get dropdown options for a specific group (value => label pairs)
     */
    public static function groupOptions(string $groupName): array
    {
        $cases = self::getGroup($groupName);
        return array_reduce($cases, function ($carry, $case) {
            $carry[$case->value] = self::label($case);
            return $carry;
        }, []);
    }
}
