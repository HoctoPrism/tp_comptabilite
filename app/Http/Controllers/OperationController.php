<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\DB;

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
            'client' => 'required',
            'nature' => 'required',
            'date_operation' => 'required',
            'category' => 'required',
            'payment' => 'required',
        ]);
        Operation::create([
            'client'=> $request->client,
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
        $clients = Client::all();
        $categories = Category::all();
        $payments = Payment::all();
        return view('operations.create', compact('categories', 'payments', 'clients'));
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
        $clients = Client::all();
        $categories = Category::all();
        $payments = Payment::all();
        $operation = Operation::findOrFail($id);
        return view('operations.edit', compact('operation', 'payments', 'categories', 'clients'));
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
            'client' => 'required',
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

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function total(Request $request): RedirectResponse
    {
        list($year, $month, $day) = explode("-", $request->total);

        $total = DB::table('operations')
            ->select(DB::raw('SUM(income) - SUM(outcome) as total'))
            ->addSelect(DB::raw('SUM(income) as income'))
            ->addSelect(DB::raw('SUM(outcome) as outcome'))
            ->whereYear('date_operation', "=", $year)
            ->whereMonth('date_operation', '=', $month)
            ->get()
            ->toArray()
        ;

        if (!empty($total[0]->total)){
            $total = $total[0]->total;
        } elseif (!empty($total[0]->outcome)){
            $total = $total[0]->outcome;
        } elseif(!empty($total[0]->income)) {
            $total = $total[0]->income;
        } else {
            $total = 'none';
        }


       return redirect()->route('operations.index')->with('total', $total)->with('year', $year)->with('month', $month);
    }

}
