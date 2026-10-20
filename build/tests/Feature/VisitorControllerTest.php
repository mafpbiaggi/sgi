<?php

use App\Models\Visitor;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Feature\TestUtils;

test('renders the visitor index page', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('visitors.index'));

    $response->assertOk();
});

test('renders the referral source label on index page', function () {
    $user = TestUtils::createUser();
    $visitor = TestUtils::createVisitor();

    $response = $this
        ->actingAs($user)
        ->get(route('visitors.index'));
    
    $response
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('visitors/index')
                ->has('visitors.data', 1)
                ->where('visitors.data.0.id', $visitor->id)
                ->where('visitors.data.0.referral_source_label', 'Indicação')
        );
});

test('paginates the visitor index page', function () {
    $user = TestUtils::createUser(true);

    for ($i = 0; $i <= 15; $i++) {
        TestUtils::createVisitor();
    }

    $this
        ->actingAs($user)
        ->get(route('visitors.index'))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('visitors/index')
                ->has('visitors.data', 15)
                ->where('visitors.current_page', 1)
                ->where('visitors.last_page', 2)
                ->where('visitors.total', 16)
        );

    $this
        ->actingAs($user)
        ->get(route('visitors.index', ['page' => 2]))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('visitors/index')
                ->has('visitors.data', 1)
                ->where('visitors.current_page', 2)
        );
});

test('renders the visitor create page', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('visitors.create'));

    $response->assertOk();
});

test('renders the visitor edit page', function () {
    $user = TestUtils::createUser();
    $visitor = TestUtils::createVisitor();

    $response = $this
        ->actingAs($user)
        ->get(route('visitors.edit', $visitor->id));

    $response->assertOk();
});

test('creates a visitor', function () {
    $user = TestUtils::createUser();

    $data = [
        'name' => 'visitor-created',
        'email' => 'visitor@visitor',
        'age' => 20,
        'phone' => '(11) 1111-1111',
        'visit_date' => '01/01/2026',
        'referral_source' => '1',
    ];

    $response = $this
        ->actingAs($user)
        ->post(route('visitors.store'), $data);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('visitors.index'));

    $visitor = Visitor::where('name', 'visitor-created')->first();

    expect($visitor)->not->toBeNull()
        ->and($visitor->name)->toBe('visitor-created');
});

test('updates a visitor', function () {
    $user = TestUtils::createUser();
    $visitor = TestUtils::createVisitor();

    $data = array_merge(
        $visitor->getRawOriginal(),
        ['name' => 'visitor-updated'],
    );

    $response = $this
        ->actingAs($user)
        ->put(route('visitors.update', $visitor->id), $data);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('visitors.index'));

    $visitor->refresh();

    expect($visitor->name)->toBe('visitor-updated');
});

test('deletes a visitor', function () {
    $user = TestUtils::createUser();
    $visitor = TestUtils::createVisitor();

    $response = $this
        ->actingAs($user)
        ->delete(route('visitors.destroy', $visitor->id));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('visitors.index'));

    expect($visitor->fresh())->toBeNull();
});

test('validates fields for visitor creation', function () {
    $user = TestUtils::createUser();

    $invalidValues = TestUtils::visitorsInvalidValues();

    foreach ($invalidValues as $key => $value) {
        $response = $this
            ->actingAs($user)
            ->post(route('visitors.store'), [$key => $value]);

        $response->assertSessionHasErrors($key);
    }
});

test('validates fields for visitor update', function () {
    $user = TestUtils::createUser();
    $toUpdate = TestUtils::createVisitor();

    $invalidValues = TestUtils::visitorsInvalidValues();

    foreach ($invalidValues as $key => $value) {
        $response = $this
            ->actingAs($user)
            ->put(route('visitors.update', $toUpdate->id), [$key => $value]);

        $response->assertSessionHasErrors($key);
    }
});

test('forbids visitor actions without an assigned visitor', function () {
    $user = TestUtils::createUser(false);
    $visitor = TestUtils::createVisitor();

    $dataset = [
        'visitors.index' => 'get',
        'visitors.create' => 'get',
        'visitors.edit' => 'get',
        'visitors.store' => 'post',
        'visitors.update' => 'put',
        'visitors.destroy' => 'delete',
    ];

    $payload = $visitor->getRawOriginal();

    foreach ($dataset as $route => $method) {
        $uri = route($route, $visitor->id);

        $response = in_array($method, ['get', 'delete'])
            ? $this->actingAs($user)->$method($uri)
            : $this->actingAs($user)->$method($uri, $payload);

        $response->assertForbidden("Route [$route] with method [$method] should be forbidden.");
    }
});
