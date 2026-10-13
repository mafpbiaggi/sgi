<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): Response
    {
        $this->authorize('permissions.index');

        $permissions = Permission::orderBy('id')->paginate(15);

        return Inertia::render('permissions/index', [
            'permissions' => $permissions,
        ]);
    }

    public function create(): Response
    {
        $this->authorize('permissions.create');

        return Inertia::render('permissions/create');
    }

    public function store(StorePermissionRequest $request): RedirectResponse
    {
        $this->authorize('permissions.store');

        Permission::create(['name' => $request->validated('name')]);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permissão criada com sucesso.');
    }

    public function edit(Permission $permission): Response
    {
        $this->authorize('permissions.edit');

        return Inertia::render('permissions/edit', [
            'permission' => $permission,
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $this->authorize('permissions.update');

        $permission->update(['name' => $request->validated('name')]);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permissão atualizada com sucesso.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $this->authorize('permissions.destroy');

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permissão excluída com sucesso.');
    }
}
