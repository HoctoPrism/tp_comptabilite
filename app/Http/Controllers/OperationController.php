<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Operation;
use App\Models\Payment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $operations = Operation::all();
        return view('operations.index', compact('operations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nature' => 'required',
            'date_operation' => 'required',
            'category' => 'required',
            'payment' => 'required',
        ]);
        Operation::create([
            'nature' => $request->nature,
            'date_operation' => $request->date_operation,
            'outcome' => $request->outcome,
            'income' => $request->income,
            'category' => $request->category,
            'payment' => $request->payment,
        ]);

        return redirect()->route('operations.index')->with('success', 'Opération ajouté avec succès !');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $categories = Category::all();
        $payments = Payment::all();
        return view('operations.create', compact('categories', 'payments'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): Application|Factory|View
    {
        return view('operations.show', ['operation' => Operation::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): Application|Factory|View
    {
        $categories = Category::all();
        $payments = Payment::all();
        $operation = Operation::findOrFail($id);
        return view('operations.edit', compact('operation', 'payments', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $updateOperation = $request->validate([
            'nature' => 'required',
            'date_operation' => 'required',
            'income' => "nullable",
            'outcome' => "nullable",
            'category' => 'required',
            'payment' => 'required',
        ]);
        Operation::whereId($id)->update($updateOperation);
        return redirect()->route('operations.index')->with('success', 'L\'opération mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id): Redirector|RedirectResponse|Application
    {
        $operation = Operation::findOrFail($id);
        $operation->delete();
        return redirect('/operations')->with('success', 'Opération supprimée');
    }
}
