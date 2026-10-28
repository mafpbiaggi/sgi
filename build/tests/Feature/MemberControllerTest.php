<?php

use App\Models\Member;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Feature\TestUtils;

test('renders the member index page', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('members.index'));

    $response->assertOk();
});

test('paginates the member index page', function () {
    $user = TestUtils::createUser(true);

    for ($i = 0; $i <= 50; $i++) {
        TestUtils::createMember($user->id);
    }

    $this
        ->actingAs($user)
        ->get(route('members.index'))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('members/index')
                ->has('members_active.data', 50)
                ->where('members_active.current_page', 1)
                ->where('members_active.last_page', 2)
                ->where('members_active.total', 51)
        );

    $this
        ->actingAs($user)
        ->get(route('members.index', ['page' => 2]))
        ->assertOk()
        ->assertInertia(
            fn(Assert $page) => $page
                ->component('members/index')
                ->has('members_active.data', 1)
                ->where('members_active.current_page', 2)
        );
});

test('renders the member create page', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('members.create'));

    $response->assertOk();
});

test('renders the member edit page', function () {
    $user = TestUtils::createUser();
    $member = TestUtils::createMember($user->id);

    $response = $this
        ->actingAs($user)
        ->get(route('members.edit', $member->id));

    $response->assertOk();
});

test('creates a member with its admission', function () {
    $user = TestUtils::createUser();

    $payload = TestUtils::memberPayload();

    $response = $this
        ->actingAs($user)
        ->post(route('members.store'), $payload);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('members.index'));

    $member = Member::with('currentAdmission')->where('name', 'member-created')->first();

    expect($member)->not->toBeNull()
        ->and($member->name)->toBe('member-created')
        ->and($member->currentAdmission->admission_order)->toBe('C001')
        ->and($member->currentAdmission->user_id)->toBe($user->id);
});

test('does not create a member without admission data', function () {
    $user = TestUtils::createUser();

    $payload = TestUtils::memberPayload();
    unset($payload['admission']);

    $this->actingAs($user)
        ->post(route('members.store'), $payload)
        ->assertSessionHasErrors('admission');

    $this->assertDatabaseMissing('members', ['name' => 'member-created']);
});

test('updates a member', function () {
    $user = TestUtils::createUser();
    $member = TestUtils::createMember($user->id);

    $payload = array_merge(
        $member->getRawOriginal(),
        ['name' => 'member-updated'],
        ['admission' => $member->currentAdmission->getRawOriginal()],
    );

    $response = $this
        ->actingAs($user)
        ->put(route('members.update', $member->id), $payload);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('members.index'));

    $member->refresh();

    expect($member->name)->toBe('member-updated');
});

test('creates a new admission when membership_type changes', function () {
    $user = TestUtils::createUser();
    $member = TestUtils::createMember($user->id);

    $payload = TestUtils::memberPayload();
    $payload['admission']['membership_status'] = 2;
    $payload['admission']['admission_order'] = 'C002';

    $this->actingAs($user)
        ->put(route('members.update', $member), $payload)
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('members.index'));

    expect($member->admissions()->count())->toBe(2)
        ->and($member->fresh()->currentAdmission->admission_order)->toBe('C002');
});

test('updates the current admission when membership_status is unchanged', function () {
    $user = TestUtils::createUser();
    $member = TestUtils::createMember($user->id);

    $payload = TestUtils::memberPayload();
    $payload['admission']['admission_order'] = 'C002';

    $this->actingAs($user)
        ->put(route('members.update', $member), $payload)
        ->assertSessionHasNoErrors();

    expect($member->admissions()->count())->toBe(1)
        ->and($member->fresh()->currentAdmission->admission_order)->toBe('C002');
});

test('deletes a member', function () {
    $user = TestUtils::createUser();
    $member = TestUtils::createMember($user->id);

    $response = $this
        ->actingAs($user)
        ->delete(route('members.destroy', $member->id));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('members.index'));

    expect($member->fresh())->toBeNull();
});

test('validates fields for member creation', function () {
    $user = TestUtils::createUser();

    $invalidValues = TestUtils::membersInvalidValues();

    foreach ($invalidValues as $key => $value) {
        $response = $this
            ->actingAs($user)
            ->post(route('members.store'), [$key => $value]);

        $response->assertSessionHasErrors($key);
    }
});

test('validates fields for member update', function () {
    $user = TestUtils::createUser();
    $toUpdate = TestUtils::createMember($user->id);

    $invalidValues = TestUtils::membersInvalidValues();

    foreach ($invalidValues as $key => $value) {
        $response = $this
            ->actingAs($user)
            ->put(route('members.update', $toUpdate->id), [$key => $value]);

        $response->assertSessionHasErrors($key);
    }
});

test('forbids member actions without an assigned member', function () {
    $user = TestUtils::createUser(false);
    $member = TestUtils::createMember($user->id);

    $dataset = [
        'members.index' => 'get',
        'members.create' => 'get',
        'members.edit' => 'get',
        'members.store' => 'post',
        'members.update' => 'put',
        'members.destroy' => 'delete',
    ];

    $payload = $member->getRawOriginal();

    foreach ($dataset as $route => $method) {
        $uri = route($route, $member->id);

        $response = in_array($method, ['get', 'delete'])
            ? $this->actingAs($user)->$method($uri)
            : $this->actingAs($user)->$method($uri, $payload);

        $response->assertForbidden("Route [$route] with method [$method] should be forbidden.");
    }
});
