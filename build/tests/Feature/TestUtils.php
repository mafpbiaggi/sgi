<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Permission;

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

    public static function usersInvalidValues(): array
    {
        return [
            'name' => str_repeat('a', 256),
            'email' => 'email_inválido',
        ];
    }

    public static function permissionsInvalidValues(): array
    {
        return ['name' => str_repeat('a', 256)];
    }
}
