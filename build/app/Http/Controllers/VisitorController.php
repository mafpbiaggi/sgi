<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Http\Requests\VisitorStoreRequest;
use App\Http\Requests\VisitorUpdateRequest;
use App\Helpers\DateHelper;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class VisitorController extends Controller
{
    /**
     * Show the visitor's page.
     */
    public function index(): Response
    {
        $this->authorize('visitors.index');

        $visitors = Visitor::orderBy('visit_date', 'DESC')->paginate(15);

        return Inertia::render('visitors/index', [
            'visitors' => $visitors,
        ]);
    }

    /**
     * Show the visitor's create page.
     */
    public function create(): Response
    {
        $this->authorize('visitors.create');

        return Inertia::render('visitors/create');
    }

    /**
     * Stores the visitor information.
     */
    public function store(VisitorStoreRequest $request): RedirectResponse
    {
        $this->authorize('visitors.store');

        return $this->withToastFeedback(
            action: function () use ($request) {
                $data = $request->safe()->merge([
                    'visit_date' => DateHelper::toDatabaseDate($request->input('visit_date')),
                ])->all();
                Visitor::create($data);
            },
            successMessage: __('Visitante cadastrado.'),
            errorMessage: __('Visitante não pôde ser cadastrado.'),
            redirectRoute: 'visitors.index',
            errorRoute: 'visitors.create',
        );
    }

    /**
     * Show the visitor's edit page.
     */
    public function edit(Visitor $visitor): Response
    {
        $this->authorize('visitors.edit');

        return Inertia::render('visitors/edit', [
            'visitor' => $visitor,
        ]);
    }

    /**
     * Update the visitor information.
     */
    public function update(VisitorUpdateRequest $request, Visitor $visitor): RedirectResponse
    {
        $this->authorize('visitors.update');

        return $this->withToastFeedback(
            action: function () use ($request, $visitor) {
                $data = $request->safe()->merge([
                    'visit_date' => DateHelper::toDatabaseDate($request->input('visit_date')),
                ])->all();
                $visitor->update($data);
            },
            successMessage: __('Visitante editado.'),
            errorMessage: __('Visitante não pôde ser editado.'),
            redirectRoute: 'visitors.index',
            errorRoute: 'visitors.edit',
        );
    }

    /**
     * Delete the visitor.
     */
    public function destroy(Visitor $visitor): RedirectResponse
    {
        $this->authorize('visitors.destroy');
        
        return $this->withToastFeedback(
            action: function () use ($visitor) {

                $visitor->delete();
            },
            successMessage: __('Visitante deletado.'),
            errorMessage: __('Visitante não pôde ser deletado.'),
            redirectRoute: 'visitors.index',
            errorRoute: 'visitors.index',
        );
    }
}
