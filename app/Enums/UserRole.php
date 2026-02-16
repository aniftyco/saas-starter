<?php

namespace App\Enums;

enum UserRole: string
{
    case God = 'GOD';
    case User = 'USER';

    public function is(UserRole $role): bool
    {
        return $this->value === $role->value;
    }

    public function oneOf(array $roles): bool
    {
        return in_array($this->value, array_map(fn ($role) => $role->value, $roles), true);
    }

    public function label(): string
    {
        return match ($this) {
            self::God => '[GOD MODE]',
            self::User => 'User',
        };
    }
}
