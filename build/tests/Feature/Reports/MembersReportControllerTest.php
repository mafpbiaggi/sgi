<?php

use Tests\Feature\TestUtils;

test('renders the members report index page', function () {
    $user = TestUtils::createUser();

    $response = $this
        ->actingAs($user)
        ->get(route('members_report.index'));

    $response->assertOk();
});
