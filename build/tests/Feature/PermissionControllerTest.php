<?php

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Inertia\Testing\AssertableInertia as Assert;

function createUser(?bool $is_master = true): User
{
    return User::factory()->create([
        'is_master' => $is_master ?? false,
    ]);
}

function createPermission(?string $data = null): Permission
{
    if ($data === null) {
        $data = "test.default";
    }

    return Permission::create([
        'name' => $data,
    ]);
}

function generateInvalidValues(): array
{
    return ['name' => str_repeat('a', 256)];
}

test('renders the permission index page', function () {
    $user = createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('permissions.index'));

    $response->assertOk();
});

test('paginates the permission index page', function () {
    $user = createUser(true);

    for ($i = 0; $i <= 15; $i++) {
        createPermission("permission.$i");
    }

    $this
        ->actingAs($user)
        ->get(route('permissions.index'))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('permissions/index')
                ->has('permissions.data', 15)
                ->where('permissions.current_page', 1)
                ->where('permissions.last_page', 2)
                ->where('permissions.total', 16)
        );

    $this
        ->actingAs($user)
        ->get(route('permissions.index', ['page' => 2]))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('permissions/index')
                ->has('permissions.data', 1)
                ->where('permissions.current_page', 2)
        );
});

test('renders the permission create page', function () {
    $user = createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('permissions.create'));

    $response->assertOk();
});

test('renders the permission edit page', function () {
    $user = createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('permissions.create'));

    $response->assertOk();
});

test('creates a permission', function () {
    $user = createUser();

    $response = $this
        ->actingAs($user)
        ->post(route('permissions.store'), [
            'name' => 'test.created'
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('permissions.index'));

    $permission = Permission::where('name', 'test.created')->first();

    expect($permission)->not->toBeNull()
        ->and($permission->name)->toBe('test.created');
});

test('updates a permission', function () {
    $user = createUser();
    $permission = createPermission();

    $response = $this
        ->actingAs($user)
        ->put(route('permissions.update', $permission), [
            'name' => 'test.new',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('permissions.index'));

    $permission->refresh();

    expect($permission->name)->toBe('test.new');
});

test('deletes a permission', function () {
    $user = createUser();
    $permission = createPermission();

    $response = $this
        ->actingAs($user)
        ->delete(route('permissions.destroy', $permission->id));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('permissions.index'));

    expect($permission->fresh())->toBeNull();
});

test('validates fields for permission creation', function () {
    $user = createUser();
    $invalidValues = generateInvalidValues();

    $response = $this
        ->actingAs($user)
        ->post(route('permissions.store'), $invalidValues);

    $response->assertSessionHasErrors('name');
});

test('validates fields for permission update', function () {
    $user = createUser();
    $permission = createPermission();
    $invalidValues = generateInvalidValues();

    $response = $this
        ->actingAs($user)
        ->put(route('permissions.update', $permission), $invalidValues);

    $response->assertSessionHasErrors('name');
});

test('forbids permission actions without an assigned role', function () {
    $user = createUser(false);
    $permission = createPermission();

    $dataset = [
        'permissions.index' => 'get',
        'permissions.create' => 'get',
        'permissions.edit' => 'get',
        'permissions.store' => 'post',
        'permissions.update' => 'put',
        'permissions.destroy' => 'delete',
    ];

    $payload = ['name' => 'permission.forbidden'];

    foreach ($dataset as $route => $method) {
        $uri = route($route, $permission->id);

        $response = in_array($method, ['get', 'delete'])
            ? $this->actingAs($user)->$method($uri)
            : $this->actingAs($user)->$method($uri, $payload);

        $response->assertForbidden("Route [$route] with method [$method] should be forbidden.");
    }
});
