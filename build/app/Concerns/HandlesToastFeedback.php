<?php

namespace App\Concerns;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

/**
 * Wraps a controller action in a try/catch and flashes a toast
 * notification (success or error) before redirecting.
 *
 * Intended for CRUD controller methods (store/update/destroy) that
 * follow the pattern: perform action -> flash feedback -> redirect.
 */
trait HandlesToastFeedback
{
    /**
     * Execute the given action, flashing a success or error toast
     * depending on the outcome, then redirect accordingly.
     *
     * @param  \Closure  $action          The action to execute (e.g. model create/update/delete).
     * @param  string    $successMessage  Message flashed on success.
     * @param  string    $errorMessage    Message flashed on failure.
     * @param  string    $redirectRoute   Route name to redirect to on success (and on error, unless $errorRoute is set).
     * @param  string|null  $errorRoute   Optional distinct route name to redirect to on error.
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function withToastFeedback(\Closure $action, string $successMessage, string $errorMessage, string $redirectRoute, ?string $errorRoute = null): RedirectResponse
    {
        try {
            $result = DB::transaction(fn() => $action());
        } catch (\Throwable $e) {
            report($e);
            Inertia::flash('toast', ['type' => 'error', 'message' => $errorMessage]);
            return to_route($errorRoute ?? $redirectRoute);
        }

        if ($result === false) {
            Inertia::flash('toast', ['type' => 'error', 'message' => $errorMessage]);
            return to_route($errorRoute ?? $redirectRoute);
        }

        Inertia::flash('toast', ['type' => 'success', 'message' => $successMessage]);
        return to_route($redirectRoute);
    }
}
