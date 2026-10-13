<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::orderBy('name')->paginate(15);

        return Inertia::render('users/index', [
            'users' => $users,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('users/create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário cadastrado com sucesso.');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('users/edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        // Só atualiza a senha se foi enviada
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário excluído com sucesso.');
    }
}
