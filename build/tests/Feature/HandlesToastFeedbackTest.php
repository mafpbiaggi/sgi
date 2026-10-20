<?php

use App\Concerns\HandlesToastFeedback;
use Spatie\Permission\Models\Permission;

function toastRunner(): object
{
    return new class {
        use HandlesToastFeedback;

        public function run(\Closure $action)
        {
            return $this->withToastFeedback(
                action: $action,
                successMessage: 'ok',
                errorMessage: 'erro',
                redirectRoute: 'users.index',
                errorRoute: 'dashboard',
            );
        }
    };
}

test('rolls back writes when the action throws', function () {
    $response = toastRunner()->run(function () {
        Permission::create(['name' => 'rollback.test']);

        throw new RuntimeException('falha simulada');
    });

    expect(Permission::where('name', 'rollback.test')->exists())->toBeFalse();
    expect($response->getTargetUrl())->toBe(route('dashboard'));
});

test('treats a false return as failure', function () {
    $response = toastRunner()->run(fn() => false);

    expect($response->getTargetUrl())->toBe(route('dashboard'));
});

test('treats a null return as success', function () {
    $response = toastRunner()->run(fn() => null);

    expect($response->getTargetUrl())->toBe(route('users.index'));
});
