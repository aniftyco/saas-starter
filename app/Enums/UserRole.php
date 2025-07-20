<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case Staff = 'STAFF';
    case User = 'USER';

    public function is(UserRole $role): bool
    {
        return $this->value === $role->value;
    }

    public function oneOf(array $roles): bool
    {
        return in_array($this->value, array_map(fn ($role) => $role->value, $roles), true);
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Staff => 'Staff',
            self::User => 'User',
        };
    }
}
