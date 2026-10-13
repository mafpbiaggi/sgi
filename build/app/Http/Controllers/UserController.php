<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): Response
    {
        $this->authorize('users.index');

        $users = User::with('roles')->orderBy('id')->paginate(15);

        return Inertia::render('users/index', [
            'users' => $users,
        ]);
    }

    public function create(): Response
    {
        $this->authorize('users.create');

        $roles = Role::orderBy('name')->get(['id', 'name']);

        return Inertia::render('users/create', [
            'roles' => $roles,
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->authorize('users.store');

        $user = User::create($request->safe()->except('roles'));
        $user->syncRoles($request->validated('roles', []));

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário cadastrado com sucesso.');
    }

    public function edit(User $user): Response
    {
        $this->authorize('users.edit');

        $roles = Role::orderBy('name')->get(['id', 'name']);

        return Inertia::render('users/edit', [
            'user'  => $user->load('roles'),
            'roles' => $roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('users.update');

        $data = $request->safe()->except('roles');

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);
        $user->syncRoles($request->validated('roles', []));

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('users.destroy');

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário excluído com sucesso.');
    }
}
