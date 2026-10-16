<?php

namespace App\Http\Controllers;

use App\Concerns\HandlesToastFeedback;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use HandlesToastFeedback;

    /**
     * Show the user's page.
     */
    public function index(): Response
    {
        $this->authorize('users.index');

        $users = User::with('roles')->orderBy('id')->paginate(15);

        return Inertia::render('users/index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the user's create page.
     */
    public function create(): Response
    {
        $this->authorize('users.create');

        $roles = Role::orderBy('name')->get(['id', 'name']);

        return Inertia::render('users/create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Stores the user information.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->authorize('users.store');

        return $this->withToastFeedback(
            action: function () use ($request) {
                $user = User::create($request->safe()->except('roles'));
                $user->syncRoles($request->validated('roles', []));
            },
            successMessage: __('Usuário cadastrado.'),
            errorMessage: __('Usuário não pôde ser cadastrado.'),
            redirectRoute: 'users.index',
            errorRoute: 'users.create',
        );
    }

    /**
     * Show the user's edit page.
     */
    public function edit(User $user): Response
    {
        $this->authorize('users.edit');

        $roles = Role::orderBy('name')->get(['id', 'name']);

        return Inertia::render('users/edit', [
            'user'  => $user->load('roles'),
            'roles' => $roles,
        ]);
    }

    /**
     * Update the user information.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->authorize('users.update');

        $data = $request->safe()->except('roles');

        if (empty($data['password'])) {
            unset($data['password']);
        }

        return $this->withToastFeedback(
            action: function () use ($request, $user, $data) {
                $user->update($data);
                $user->syncRoles($request->validated('roles', []));
            },
            successMessage: __('Usuário editado.'),
            errorMessage: __('Usuário não pôde ser editado.'),
            redirectRoute: 'users.index',
            errorRoute: 'users.edit',
        );
    }

    /**
     * Delete the user.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('users.destroy');

        return $this->withToastFeedback(
            action: function () use ($user) {
                $user->delete();
            },
            successMessage: __('Usuário deletado.'),
            errorMessage: __('Usuário não pôde ser deletado.'),
            redirectRoute: 'users.index',
            errorRoute: 'users.index',
        );
    }
}
