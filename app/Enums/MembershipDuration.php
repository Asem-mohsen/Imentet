<?php

namespace App\Enums;

enum MembershipDuration: string
{
    case WEEK = 'week';
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';
    case SEMI_ANNUAL = 'semi-annual';
    case OPEN = 'open';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return [
            self::WEEK->value => 'Week',
            self::MONTHLY->value => 'Monthly',
            self::YEARLY->value => 'Yearly',
            self::SEMI_ANNUAL->value => 'Semi-Annual',
            self::OPEN->value => 'Open',
        ];
    }
}