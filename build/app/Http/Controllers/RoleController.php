<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): Response
    {
        $this->authorize('roles.index');

        $roles = Role::withCount('permissions')->orderBy('id')->paginate(15);

        return Inertia::render('roles/index', [
            'roles' => $roles,
        ]);
    }

    public function create(): Response
    {
        $this->authorize('roles.create');

        $permissions = Permission::orderBy('name')->get(['id', 'name']);

        return Inertia::render('roles/create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $this->authorize('roles.store');

        $role = Role::create(['name' => $request->validated('name')]);
        $role->syncPermissions($request->validated('permissions', []));

        return redirect()
            ->route('roles.index')
            ->with('success', 'Grupo criado com sucesso.');
    }

    public function edit(Role $role): Response
    {
        $this->authorize('roles.edit');
   
        $permissions = Permission::orderBy('name')->get(['id', 'name']);

        return Inertia::render('roles/edit', [
            'role'        => $role->load('permissions'),
            'permissions' => $permissions,
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $this->authorize('roles.update');

        $role->update(['name' => $request->validated('name')]);
        $role->syncPermissions($request->validated('permissions', []));

        return redirect()
            ->route('roles.index')
            ->with('success', 'Grupo atualizado com sucesso.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('roles.destroy');

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Grupo excluído com sucesso.');
    }
}
