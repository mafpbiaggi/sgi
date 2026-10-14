<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Helpers\DateHelper;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class VisitorController extends Controller
{
    public function index(): Response
    {
        $this->authorize('visitors.index');

        $visitors = Visitor::orderBy('visit_date', 'DESC')->paginate(15);

        return Inertia::render('visitors/index', [
            'visitors' => $visitors,
        ]);
    }

    public function create(): Response
    {
        $this->authorize('visitors.create');

        return Inertia::render('visitors/create');
    }

    public function store(StoreVisitorRequest $request): RedirectResponse
    {
        $this->authorize('visitors.store');

        $request['visit_date'] = DateHelper::toDatabaseDate($request->input('visit_date'));

        Visitor::create($request->all());

        return redirect()
            ->route('visitors.index')
            ->with('success', 'Visitante cadastrado com sucesso.');
    }

    public function edit(Visitor $visitor): Response
    {
        $this->authorize('visitors.edit');

        return Inertia::render('visitors/edit', [
            'visitor' => $visitor,
        ]);
    }

    public function update(UpdateVisitorRequest $request, Visitor $visitor): RedirectResponse
    {
        $this->authorize('visitors.update');

        $request['visit_date'] = DateHelper::toDatabaseDate($request->input('visit_date'));

        $visitor->update($request->all());

        return redirect()
            ->route('visitors.index')
            ->with('success', 'Visitante atualizado com sucesso.');
    }

    public function destroy(Visitor $visitor): RedirectResponse
    {
        $this->authorize('visitors.destroy');

        $visitor->delete();

        return redirect()
            ->route('visitors.index')
            ->with('success', 'Visitante excluído com sucesso.');
    }
}
