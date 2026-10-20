<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestUtils
{
    public static function createUser(?bool $is_master = true): User
    {
        return User::factory()->create([
            'is_master' => $is_master ?? false,
        ]);
    }

    public static function createPermission(?string $data = null): Permission
    {
        if ($data === null) {
            $data = "test.default";
        }

        return Permission::create([
            'name' => $data,
        ]);
    }

    public static function createRole(?string $data = null): Role
    {
        if ($data === null) {
            $data = "role-default";
        }

        return Role::create([
            'name' => $data,
        ]);
    }

    public static function invalidNameValue(): string
    {
        return str_repeat('a', 256);
    }

    public static function usersInvalidValues(): array
    {
        return [
            'name' => TestUtils::invalidNameValue(),
            'email' => 'email_inválido',
        ];
    }

    public static function permissionsInvalidValues(): array
    {
        return ['name' => TestUtils::invalidNameValue()];
    }

    public static function rolesInvalidValues(): array
    {
        return ['name' => TestUtils::invalidNameValue()];
    }
}
