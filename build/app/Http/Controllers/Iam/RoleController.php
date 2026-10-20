<?php

namespace App\Http\Controllers\Iam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Iam\RoleStoreRequest;
use App\Http\Requests\Iam\RoleUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Show the role's page.
     */
    public function index(): Response
    {
        $this->authorize('roles.index');

        $roles = Role::withCount('permissions')->orderBy('id')->paginate(15);

        return Inertia::render('iam/roles/index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the role's create page.
     */
    public function create(): Response
    {
        $this->authorize('roles.create');

        $permissions = Permission::orderBy('name')->get(['id', 'name']);

        return Inertia::render('iam/roles/create', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * stores the role information.
     */
    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $this->authorize('roles.store');

        return $this->withToastFeedback(
            action: function () use ($request) {
                $role = Role::create($request->safe()->except('permissions'));
                $role->syncPermissions($request->validated('permissions', []));
            },
            successMessage: __('Grupo cadastrado.'),
            errorMessage: __('Grupo não pôde ser cadastrado.'),
            redirectRoute: 'roles.index',
            errorRoute: 'roles.create',
        );
    }

    /**
     * Show the role's edit page.
     */
    public function edit(Role $role): Response
    {
        $this->authorize('roles.edit');

        $permissions = Permission::orderBy('name')->get(['id', 'name']);

        return Inertia::render('iam/roles/edit', [
            'role' => $role->load('permissions'),
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the role information.
     */
    public function update(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        $this->authorize('roles.update');

        $data = $request->safe()->except('permissions');

        return $this->withToastFeedback(
            action: function () use ($request, $role, $data) {
                $role->update($data);
                $role->syncPermissions($request->validated('permissions', []));
            },
            successMessage: __('Grupo editado.'),
            errorMessage: __('Grupo não pôde ser editado.'),
            redirectRoute: 'roles.index',
            errorRoute: 'roles.edit',
        );
    }

    /**
     * Delete the role.
     */
    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('roles.destroy');

        return $this->withToastFeedback(
            action: function () use ($role) {
                $role->delete();
            },
            successMessage: __('Grupo deletado.'),
            errorMessage: __('Grupo não pôde ser deletado.'),
            redirectRoute: 'roles.index',
            errorRoute: 'roles.index',
        );
    }
}
