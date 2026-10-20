<?php

use App\Models\User;
use Tests\Feature\TestUtils;
use Inertia\Testing\AssertableInertia as Assert;

test('renders the user index page', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('users.index'));

    $response->assertOk();
});

test('paginates the user index page', function () {
    $user = TestUtils::createUser(true);

    for ($i = 0; $i <= 15; $i++) {
        TestUtils::createUser(false);
    }

    $this
        ->actingAs($user)
        ->get(route('users.index'))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('iam/users/index')
                ->has('users.data', 15)
                ->where('users.current_page', 1)
                ->where('users.last_page', 2)
                ->where('users.total', 17)
        );

    $this
        ->actingAs($user)
        ->get(route('users.index', ['page' => 2]))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('iam/users/index')
                ->has('users.data', 2)
                ->where('users.current_page', 2)
        );
});

test('renders the user create page', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('users.create'));

    $response->assertOk();
});

test('renders the user edit page', function () {
    $user = TestUtils::createUser();
    $toTest = TestUtils::createUser(false);

    $response = $this
        ->actingAs($user)
        ->get(route('users.edit', $toTest->id));

    $response->assertOk();
});

test('creates a user', function () {
    $user = TestUtils::createUser();

    $data = [
        'name' => 'user_store',
        'email' => 'user_store@teste.com.br',
        'password' => 'user_store_password',
        'password_confirmation' => 'user_store_password',
        'is_master' => false,
        'roles.*' => ['admin', 'exists:roles,name'],
    ];

    $response = $this
        ->actingAs($user)
        ->post(route('users.store', $data));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('users.index'));

    $created = User::where('id', 2)->first();

    expect($created->id)->toBe(2);
});

test('updates a user', function () {
    $user = TestUtils::createUser();
    $toUpdate = TestUtils::createUser(false);

    $response = $this
        ->actingAs($user)
        ->put(route('users.update', $toUpdate), [
            'name' => 'New name for user',
            'email' => 'new@email'
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('users.index'));

    $toUpdate->refresh();

    expect($toUpdate->name)->toBe('New name for user');
});

test('deletes a user', function () {
    $user = TestUtils::createUser();
    $toDelete = TestUtils::createUser(false);

    $response = $this
        ->actingAs($user)
        ->delete(route('users.destroy', $toDelete->id));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('users.index'));

    expect($toDelete->fresh())->toBeNull();
});

test('validates fields for user creation', function () {
    $user = TestUtils::createUser();
    $invalidValues = TestUtils::usersInvalidValues();

    $response = $this
        ->actingAs($user)
        ->post(route('users.store'), $invalidValues);

    $response->assertSessionHasErrors([
        'name',
        'email',
    ]);
});

test('validates fields for user update', function () {
    $user = TestUtils::createUser();
    $toUpdate = TestUtils::createUser();
    $invalidValues = TestUtils::usersInvalidValues();

    $response = $this
        ->actingAs($user)
        ->put(route('users.update', $toUpdate), $invalidValues);

    $response->assertSessionHasErrors([
        'name',
        'email',
    ]);
});

test('forbids users actions without an assigned role', function () {
    $user = TestUtils::createUser(false);

    $dataset = [
        'users.index' => 'get',
        'users.create' => 'get',
        'users.edit' => 'get',
        'users.store' => 'post',
        'users.update' => 'put',
        'users.destroy' => 'delete',
    ];

    $payload = [
        'name' => 'Forbidden',
        'email' => 'payload@forbiden',
        'password' => 'password_forbidden',
        'password_confirmation' => 'password_forbidden',
        ];

    foreach ($dataset as $route => $method) {
        $uri = route($route, $user->id);

        $response = in_array($method, ['get', 'delete'])
            ? $this->actingAs($user)->$method($uri)
            : $this->actingAs($user)->$method($uri, $payload);

        $response->assertForbidden("Route [$route] with method [$method] should be forbidden.");
    }
});
