<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private bool $allowUserActions = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());

        Gate::before(function ($user, string $ability) {
            if (str_starts_with($ability, 'users.')) {
                return $this->allowUserActions;
            }

            return null;
        });
    }

    private function validData(array $overrides = []): array
    {
        return array_replace([
            'name' => 'teste',
            'email' => 'email@email',
            'password' => 'password',
        ], $overrides);
    }

    public function test_user_can_be_created(): void
    {
        $data = $this->validData([
            'name' => 'user_store',
            'email' => 'user_store@teste.com.br',
            'password' => 'user_store_password',
        ]);

        $this->post(route('users.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseCount('users', 2);
    }

    public function test_user_can_be_upgraded(): void
    {
        $user = User::factory()->create();

        $data = $this->validData([
            'name' => 'Novo nome',
            'email' => 'novo_email@test.com.br',
        ]);

        $this->put(route('users.update', $user), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseCount('users', 2);
    }

    public function test_user_can_be_destroyed(): void
    {
        $user = User::factory()->create();

        $this->delete(route('users.destroy', $user))
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function test_users_are_ordered_by_id_on_index(): void
    {
        $older = User::factory()->create();
        $newer = User::factory()->create();

        $this->get(route('users.index'))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('users/index')
                    ->has('users.data', 3)
                    ->where('users.data.1.id', $older->id)
                    ->where('users.data.2.id', $newer->id)
                    ->where('users.per_page', 15)
                    ->where('users.total', 3)
            );
    }

    public function test_users_are_paginated_by_fifteen_per_page(): void
    {
        User::factory()->count(15)->create();

        $this->get(route('users.index'))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('users/index')
                    ->has('users.data', 15)
                    ->where('users.current_page', 1)
                    ->where('users.last_page', 2)
                    ->where('users.total', 16)
            );

        $this->get(route('users.index', ['page' => 2]))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('users/index')
                    ->has('users.data', 1)
                    ->where('users.current_page', 2)
            );
    }

    public function test_create_page_can_be_rendered(): void
    {
        $this->get(route('users.create'))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('users/create')
            );
    }

    public function test_edit_page_can_be_rendered_with_request(): void
    {
        $user = User::factory()->create();

        $this->get(route('users.edit', $user))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('users/edit')
                    ->where('user.id', $user->id)
                    ->where('user.name', $user->name)
                    ->where('user.email', $user->email)
            );
    }

    public function test_user_can_store_and_update_with_required_fields(): void
    {
        $user = User::factory()->create();
        $original = $user->getRawOriginal();

        $requiredFields = [
            'name',
            'email',
        ];

        $this->post(route('users.store'), [])
            ->assertSessionHasErrors($requiredFields);

        $this->put(route('users.update', $user), [])
            ->assertSessionHasErrors($requiredFields);

        $this->assertDatabaseCount('users', 2);

        $this->assertEqualsCanonicalizing(
            $original,
            $user->fresh()->getRawOriginal()
        );
    }

    public function test_user_can_not_store_and_update_with_invalid_field_values(): void
    {
        $user = User::factory()->create();
        $original = $user->getRawOriginal();

        $invalidValues = [
            'name' => str_repeat('a', 256),
            'email' => 'email-invalido',
            'password' => str_repeat('a', 7),
        ];

        foreach ($invalidValues as $field => $value) {
            $data = $this->validData([$field => $value]);

            $this->post(route('users.store'), $data)
                ->assertSessionHasErrors([$field]);

            $this->put(route('users.update', $user), $data)
                ->assertSessionHasErrors([$field]);
        }

        $this->assertDatabaseCount('users', 2);

        $this->assertEqualsCanonicalizing(
            $original,
            $user->fresh()->getRawOriginal()
        );
    }

    public function test_user_actions_return_forbidden_without_permission(): void
    {
        $user = User::factory()->create();
        $original = $user->getRawOriginal();

        $this->allowUserActions = false;

        $this->get(route('users.index'))
            ->assertForbidden();

        $this->get(route('users.create'))
            ->assertForbidden();

        $this->post(route('users.store'), $this->validData([
            'name' => 'teste',
            'email' => 'email@email',
            'password' => 'password',
        ]))
            ->assertForbidden();

        $this->get(route('users.edit', $user))
            ->assertForbidden();

        $this->put(
            route('users.update', $user),
            $this->validData([
                'name' => 'Alteração proibida',
                'email' => 'alteracao@proibida'
            ])
        )
            ->assertForbidden();

        $this->delete(route('users.destroy', $user))
            ->assertForbidden();

        $this->assertDatabaseCount('users', 2);

        $this->assertEqualsCanonicalizing(
            $original,
            $user->fresh()->getRawOriginal()
        );
    }
}
