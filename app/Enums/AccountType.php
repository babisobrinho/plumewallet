<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumGroupMethods;

enum AccountType: string
{
    use HasEnumBasicMethods, HasEnumGroupMethods;

    // Asset accounts (money you own)
    case CASH = 'cash';
    case CHECKING = 'checking';
    case SAVINGS = 'savings';

    // Liability accounts (money you owe)
    case CREDIT_CARD = 'credit_card';
    case LINE_OF_CREDIT = 'line_of_credit';

    /**
     * Define account type groupings for categorization
     *
     * @return array<string, array<self>>
     */
    public static function groups(): array
    {
        return [
            'cash' => [
                self::CASH,
                self::CHECKING,
                self::SAVINGS
            ],
            'credit' => [
                self::CREDIT_CARD,
                self::LINE_OF_CREDIT
            ],
        ];
    }
}
