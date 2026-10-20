<?php

use Spatie\Permission\Models\Role;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Feature\TestUtils;

test('renders the role index page', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('roles.index'));

    $response->assertOk();
});

test('paginates the role index page', function () {
    $user = TestUtils::createUser(true);

    for ($i = 0; $i <= 15; $i++) {
        TestUtils::createRole("role-$i");
    }

    $this
        ->actingAs($user)
        ->get(route('roles.index'))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('roles/index')
                ->has('roles.data', 15)
                ->where('roles.current_page', 1)
                ->where('roles.last_page', 2)
                ->where('roles.total', 16)
        );

    $this
        ->actingAs($user)
        ->get(route('roles.index', ['page' => 2]))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('roles/index')
                ->has('roles.data', 1)
                ->where('roles.current_page', 2)
        );
});

test('renders the role create page', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('roles.create'));

    $response->assertOk();
});

test('renders the role edit page', function () {
    $user = TestUtils::createUser();
    $role = TestUtils::createRole();

    $response = $this
        ->actingAs($user)
        ->get(route('roles.edit', $role->id));

    $response->assertOk();
});

test('creates a role', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->post(route('roles.store'), [
            'name' => 'test-created'
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('roles.index'));

    $role = Role::where('name', 'test-created')->first();

    expect($role)->not->toBeNull()
        ->and($role->name)->toBe('test-created');
});

test('updates a role', function () {
    $user = TestUtils::createUser();
    $role = TestUtils::createRole();

    $response = $this
        ->actingAs($user)
        ->put(route('roles.update', $role), [
            'name' => 'test.new',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('roles.index'));

    $role->refresh();

    expect($role->name)->toBe('test.new');
});

test('deletes a role', function () {
    $user = TestUtils::createUser();
    $role = TestUtils::createRole();

    $response = $this
        ->actingAs($user)
        ->delete(route('roles.destroy', $role->id));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('roles.index'));

    expect($role->fresh())->toBeNull();
});

test('validates fields for role creation', function () {
    $user = TestUtils::createUser();
    $existingRole = TestUtils::createRole();

    $invalidValues = array_merge(
        ['name' => $existingRole->name],
        TestUtils::rolesInvalidValues(),
    );

    foreach ($invalidValues as $key => $value) {
        $response = $this
            ->actingAs($user)
            ->post(route('roles.store'), [$key => $value]);

        $response->assertSessionHasErrors($key);
    }
});

test('validates fields for role update', function () {
    $user = TestUtils::createUser();
    $existingRole = TestUtils::createRole();
    $toUpdate = TestUtils::createRole('other-role');

    $invalidValues = array_merge(
        ['name' => $existingRole->name],
        TestUtils::rolesInvalidValues(),
    );

    foreach ($invalidValues as $key => $value) {
        $response = $this
            ->actingAs($user)
            ->put(route('roles.update', $toUpdate->id), [$key => $value]);

        $response->assertSessionHasErrors($key);
    }
});

test('forbids role actions without an assigned role', function () {
    $user = TestUtils::createUser(false);
    $role = TestUtils::createRole();

    $dataset = [
        'roles.index' => 'get',
        'roles.create' => 'get',
        'roles.edit' => 'get',
        'roles.store' => 'post',
        'roles.update' => 'put',
        'roles.destroy' => 'delete',
    ];

    $payload = ['name' => 'role.forbidden'];

    foreach ($dataset as $route => $method) {
        $uri = route($route, $role->id);

        $response = in_array($method, ['get', 'delete'])
            ? $this->actingAs($user)->$method($uri)
            : $this->actingAs($user)->$method($uri, $payload);

        $response->assertForbidden("Route [$route] with method [$method] should be forbidden.");
    }
});
