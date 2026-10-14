<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class VisitorControllerTest extends TestCase
{
    use RefreshDatabase;

    private bool $allowVisitorActions = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());

        Gate::before(function ($user, string $ability) {
            if (str_starts_with($ability, 'visitors.')) {
                return $this->allowVisitorActions;
            }

            return null;
        });
    }

    private function validData(array $overrides = []): array
    {
        return array_replace([
            'name' => 'Maria da Silva',
            'age' => 35,
            'phone' => '(11) 99999-9999',
            'email' => 'maria@example.com',
            'visit_date' => '14/10/2026',
            'attends_church' => 'Não',
            'prayer_request' => 'Pela família',
            'referral_source' => '2',
            'referral_source_social_media' => 'Youtube',
            'referral_source_other' => 'Outro',
        ], $overrides);
    }

    private function createVisitor(array $overrides = []): Visitor
    {
        return Visitor::create(
            $this->validData(array_replace([
                'visit_date' => '2026-10-14',
            ], $overrides))
        );
    }

    public function test_index_renders_visitors_ordered_by_visit_date(): void
    {
        $older = $this->createVisitor([
            'visit_date' => '2026-10-10',
        ]);

        $newer = $this->createVisitor([
            'visit_date' => '2026-10-14',
        ]);

        $this->get(route('visitors.index'))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('visitors/index')
                    ->has('visitors.data', 2)
                    ->where('visitors.data.0.id', $newer->id)
                    ->where('visitors.data.1.id', $older->id)
                    ->where('visitors.per_page', 15)
                    ->where('visitors.total', 2)
            );
    }

    public function test_index_paginates_fifteen_visitors_per_page(): void
    {
        for ($day = 1; $day <= 16; $day++) {
            $this->createVisitor([
                'visit_date' => sprintf('2026-10-%02d', $day),
                'email' => "visitor{$day}@example.com",
            ]);
        }

        $this->get(route('visitors.index'))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('visitors/index')
                    ->has('visitors.data', 15)
                    ->where('visitors.current_page', 1)
                    ->where('visitors.last_page', 2)
                    ->where('visitors.total', 16)
            );

        $this->get(route('visitors.index', ['page' => 2]))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('visitors/index')
                    ->has('visitors.data', 1)
                    ->where('visitors.current_page', 2)
            );
    }

    public function test_create_renders_creation_page(): void
    {
        $this->get(route('visitors.create'))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('visitors/create')
            );
    }

    public function test_store_creates_visitor(): void
    {
        $data = $this->validData();

        $this->post(route('visitors.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('visitors.index'))
            ->assertSessionHas(
                'success',
                'Visitante cadastrado com sucesso.'
            );

        $this->assertDatabaseCount('visitors', 1);

        $this->assertDatabaseHas('visitors', array_replace($data, [
            'visit_date' => '2026-10-14',
        ]));
    }

    public function test_store_accepts_null_optional_fields(): void
    {
        $data = $this->validData([
            'attends_church' => null,
            'prayer_request' => null,
            'referral_source_social_media' => null,
            'referral_source_other' => null,
        ]);

        $this->post(route('visitors.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('visitors.index'));

        $this->assertDatabaseHas('visitors', array_replace($data, [
            'visit_date' => '2026-10-14',
        ]));
    }

    public function test_edit_renders_page_with_requested_visitor(): void
    {
        $visitor = $this->createVisitor();

        $this->get(route('visitors.edit', $visitor))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('visitors/edit')
                    ->where('visitor.id', $visitor->id)
                    ->where('visitor.name', $visitor->name)
                    ->where('visitor.email', $visitor->email)
            );
    }

    public function test_update_changes_visitor(): void
    {
        $visitor = $this->createVisitor();

        $data = $this->validData([
            'name' => 'Maria Souza',
            'age' => 36,
            'email' => 'souza@example.com',
            'visit_date' => '20/10/2026',
        ]);

        $this->put(route('visitors.update', $visitor), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('visitors.index'))
            ->assertSessionHas(
                'success',
                'Visitante atualizado com sucesso.'
            );

        $this->assertDatabaseCount('visitors', 1);

        $this->assertDatabaseHas('visitors', array_replace($data, [
            'id' => $visitor->id,
            'visit_date' => '2026-10-20',
        ]));
    }

    public function test_store_and_update_require_mandatory_fields(): void
    {
        $visitor = $this->createVisitor();
        $original = $visitor->getRawOriginal();

        $requiredFields = [
            'name',
            'age',
            'phone',
            'email',
            'visit_date',
            'referral_source',
        ];

        $this->post(route('visitors.store'), [])
            ->assertSessionHasErrors($requiredFields);

        $this->put(route('visitors.update', $visitor), [])
            ->assertSessionHasErrors($requiredFields);

        $this->assertDatabaseCount('visitors', 1);

        $this->assertEqualsCanonicalizing(
            $original,
            $visitor->fresh()->getRawOriginal()
        );
    }

    public function test_store_and_update_reject_invalid_field_values(): void
    {
        $visitor = $this->createVisitor();
        $original = $visitor->getRawOriginal();

        $invalidValues = [
            'name' => str_repeat('a', 51),
            'age' => 'abc',
            'phone' => str_repeat('1', 16),
            'email' => 'email-invalido',
            'visit_date' => '2026-10-14',
            'attends_church' => str_repeat('a', 71),
            'prayer_request' => str_repeat('a', 71),
            'referral_source' => str_repeat('a', 21),
            'referral_source_social_media' => str_repeat('a', 51),
            'referral_source_other' => str_repeat('a', 51),
        ];

        foreach ($invalidValues as $field => $value) {
            $data = $this->validData([$field => $value]);

            $this->post(route('visitors.store'), $data)
                ->assertSessionHasErrors([$field]);

            $this->put(route('visitors.update', $visitor), $data)
                ->assertSessionHasErrors([$field]);
        }

        $this->assertDatabaseCount('visitors', 1);

        $this->assertEqualsCanonicalizing(
            $original,
            $visitor->fresh()->getRawOriginal()
        );
    }

    public function test_destroy_visitor(): void
    {
        $visitor = $this->createVisitor();

        $this->delete(route('visitors.destroy', $visitor))
            ->assertRedirect(route('visitors.index'))
            ->assertSessionHas(
                'success',
                'Visitante excluído com sucesso.'
            );

        $this->assertDatabaseMissing('visitors', [
            'id' => $visitor->id,
        ]);
    }

    public function test_actions_return_forbidden_without_permission(): void
    {
        $visitor = $this->createVisitor();
        $original = $visitor->getRawOriginal();

        $this->allowVisitorActions = false;

        $this->get(route('visitors.index'))
            ->assertForbidden();

        $this->get(route('visitors.create'))
            ->assertForbidden();

        $this->post(route('visitors.store'), $this->validData())
            ->assertForbidden();

        $this->get(route('visitors.edit', $visitor))
            ->assertForbidden();

        $this->put(
            route('visitors.update', $visitor),
            $this->validData(['name' => 'Alteração proibida'])
        )->assertForbidden();

        $this->delete(route('visitors.destroy', $visitor))
            ->assertForbidden();

        $this->assertDatabaseCount('visitors', 1);

        $this->assertEqualsCanonicalizing(
            $original,
            $visitor->fresh()->getRawOriginal()
        );
    }

    public function test_index_sends_referral_source_label(): void
    {
        $visitor = $this->createVisitor([
            'referral_source' => '3',
        ]);

        $this->get(route('visitors.index'))
            ->assertOk()
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('visitors/index')
                    ->has('visitors.data', 1)
                    ->where('visitors.data.0.id', $visitor->id)
                    ->where('visitors.data.0.referral_source_label', 'Moro perto')
            );
    }
}
