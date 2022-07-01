<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
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
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
            'email' => 'nullable',
        ]);
        Client::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès !');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('clients.create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): Application|Factory|View
    {
        return view('clients.show', ['client' => Client::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): Application|Factory|View
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
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
        $updateClient = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
            'email' => 'nullable',
        ]);
        Client::whereId($id)->update($updateClient);
        return redirect()->route('clients.index')->with('success', 'Le client aété mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id): Redirector|RedirectResponse|Application
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect('/clients')->with('success', 'Client supprimé');
    }
}
