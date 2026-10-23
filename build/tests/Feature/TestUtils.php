<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Visitor;
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

    public static function createVisitor(?array $data = null): Visitor
    {
        if ($data === null) {
            $data = [
                'name' => 'visitor',
                'email' => 'visitor@visitor',
                'age' => 45,
                'phone' => '(11) 99999-9999',
                'visit_date' => '01/01/2026',
                'attends_church' => 'Yes',
                'prayer_request' => 'No',
                'referral_source' => '1',
                'referral_source_social_media' => '',
                'referral_source_other' => '',
            ];
        }

        return Visitor::create($data);
    }

    public static function invalidNameValue(): string
    {
        return str_repeat('a', 256);
    }

    public static function invalidEmailValue(): string
    {
        return 'email_invalido';
    }

    public static function invalidPhoneValue(): string
    {
        return str_repeat('1', 16);
    }

    public static function invalidDateValue(): string
    {
        return '2026-01-01';
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

    public static function visitorsInvalidValues(): array
    {
        return [
            'name' => TestUtils::invalidNameValue(),
            'email' => TestUtils::invalidEmailValue(),
            'age' => 'string',
            'phone' => TestUtils::invalidPhoneValue(),
            'visit_date' => TestUtils::invalidDateValue(),
            'attends_church' => str_repeat('a', 71),
            'prayer_request' => str_repeat('a', 71),
            'referral_source' => '9',
            'referral_source_social_media' => str_repeat('a', 51),
            'referral_source_other' => str_repeat('a', 51),
        ];
    }
}
