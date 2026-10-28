<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Visitor;
use App\Models\Member;
use App\Models\MemberAdmission;
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

    public static function memberPayload(): array
    {
        return [
            'admission' => [
                'membership_type' => 1,
                'membership_status' => 1,
                'admission_order' => 'C001',
                'admission_date' => '01/01/2026',
                'admission_reason' => 1,
                'admission_minute' => 900,
            ],
            'name' => 'member-created',
            'gender' => 1,
            'birth_date' => '02/02/2002',
            'birthplace' => 'birthplace',
            'marital_status' => 1,
            'father_name' => 'father name',
            'mother_name' => 'mother name',
            'street' => 'street',
            'number' => '100',
            'neighborhood' => 'neighborhood',
            'postal_code' => '00000-000',
            'city' => 'city',
            'state' => 'UF',
            'is_under_discipline' => false,
            'is_baptized' => true,
            'has_professed_faith' => true,
        ];
    }

    public static function createMember(?int $user_id = null): Member
    {
        $payload = self::memberPayload();

        $admission = $payload['admission'];
        unset($payload['admission']);

        $member = Member::create($payload);
        $admissionModel = new MemberAdmission($admission);
        $admissionModel->user_id = $user_id;

        $member->admissions()->save($admissionModel);

        return $member;
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
            'name' => self::invalidNameValue(),
            'email' => 'email_inválido',
        ];
    }

    public static function permissionsInvalidValues(): array
    {
        return ['name' => self::invalidNameValue()];
    }

    public static function rolesInvalidValues(): array
    {
        return ['name' => self::invalidNameValue()];
    }

    public static function visitorsInvalidValues(): array
    {
        return [
            'name' => self::invalidNameValue(),
            'email' => self::invalidEmailValue(),
            'age' => 'string',
            'phone' => self::invalidPhoneValue(),
            'visit_date' => self::invalidDateValue(),
            'attends_church' => str_repeat('a', 71),
            'prayer_request' => str_repeat('a', 71),
            'referral_source' => '9',
            'referral_source_social_media' => str_repeat('a', 51),
            'referral_source_other' => str_repeat('a', 51),
        ];
    }

    public static function membersInvalidValues(): array
    {
        return [
            'name' => self::invalidNameValue(),
            'gender' => 3,
            'birth_date' => self::invalidDateValue(),
            'birthplace' => str_repeat('a', 256),
            'document_rg' => str_repeat('a', 13),
            'document_cpf' => str_repeat('a', 19),
            'marital_status' => 15,
            'marriage_date' => self::invalidDateValue(),
            'spouse_name' => str_repeat('a', 256),
            'father_name' => str_repeat('a', 256),
            'mother_name' => str_repeat('a', 256),
            'email' => self::invalidEmailValue(),
            'phone' => self::invalidPhoneValue(),
            'secondary_phone' => self::invalidPhoneValue(),
            'mobile_phone' => self::invalidPhoneValue(),
            'street' => str_repeat('a', 256),
            'number' => str_repeat('a', 7),
            'complement' => str_repeat('a', 256),
            'neighborhood' => str_repeat('a', 256),
            'postal_code' => str_repeat('a', 10),
            'city' => str_repeat('a', 256),
            'state' => str_repeat('a', 3),
            'educational_level' => 20,
            'occupation' => str_repeat('a', 256),
            'is_under_discipline' => 3,
            'is_baptized' => 3,
            'baptism_date' => self::invalidDateValue(),
            'baptism_church' => str_repeat('a', 256),
            'baptism_pastor' => str_repeat('a', 256),
            'has_professed_faith' => 3,
            'profession_of_faith_date' => self::invalidDateValue(),
            'profession_of_faith_church' => str_repeat('a', 256),
            'profession_of_faith_pastor' => str_repeat('a', 256),
            'last_church' => str_repeat('a', 256),
        ];
    }
}
