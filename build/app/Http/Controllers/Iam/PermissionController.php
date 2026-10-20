<?php

namespace App\Http\Controllers\Iam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Iam\PermissionStoreRequest;
use App\Http\Requests\Iam\PermissionUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Show the permission's page.
     */
    public function index(): Response
    {
        $this->authorize('permissions.index');

        $permissions = Permission::orderBy('id')->paginate(15);

        return Inertia::render('iam/permissions/index', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the permission's create page.
     */
    public function create(): Response
    {
        $this->authorize('permissions.create');

        return Inertia::render('iam/permissions/create');
    }

    /**
     * stores the permission information.
     */
    public function store(PermissionStoreRequest $request): RedirectResponse
    {
        $this->authorize('permissions.store');

        return $this->withToastFeedback(
            action: function () use ($request) {
                Permission::create($request->safe()->all());
            },
            successMessage: __('Permissão cadastrada.'),
            errorMessage: __('Permissão não pôde ser cadastrada.'),
            redirectRoute: 'permissions.index',
            errorRoute: 'permissions.create',
        );
    }

    /**
     * Show the permission's edit page.
     */
    public function edit(Permission $permission): Response
    {
        $this->authorize('permissions.edit');

        return Inertia::render('iam/permissions/edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the permissions information.
     */
    public function update(PermissionUpdateRequest $request, Permission $permission): RedirectResponse
    {
        $this->authorize('permissions.update');

        return $this->withToastFeedback(
            action: function () use ($request, $permission) {
                $permission->update($request->safe()->all());
            },
            successMessage: __('Permissão editada.'),
            errorMessage: __('Permissão não pôde ser editada.'),
            redirectRoute: 'permissions.index',
            errorRoute: 'permissions.edit',
        );
    }

    /**
     * Delete the permission.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $this->authorize('permissions.destroy');

        return $this->withToastFeedback(
            action: function () use ($permission) {
                $permission->delete();
            },
            successMessage: __('Permissão deletada.'),
            errorMessage: __('Permissão não pôde ser deletada.'),
            redirectRoute: 'permissions.index',
            errorRoute: 'permissions.index',
        );
    }
}
