<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Comptabilite - Liste des operations</title>
</head>
<body>
@extends('layout')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <div class="tab-content">
                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <h3>Liste des operations</h3>
                            <a href="{{ route('operations.create')}}" class="btn btn-primary btn-sm">Ajouter</a>
                            @if(session()->get('success'))
                              <div class="alert alert-success">
                                {{ session()->get('success') }}
                              </div><br />
                            @endif
                            <!-- Tableau -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Nature</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Débits</th>
                                    <th scope="col">Crédits</th>
                                    <th scope="col">Catégorie</th>
                                    <th scope="col">Mode de paiement</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($operations as $operation)
                                    <tr>
                                        <td>{{$operation->id}}</td>
                                        <td>{{$operation->clients->firstname}} {{$operation->clients->lastname}}</td>
                                        <td>{{$operation->nature}}</td>
                                        <td>{{$operation->date_operation}}</td>
                                        <td>{{$operation->outcome}}</td>
                                        <td>{{$operation->income}}</td>
                                        @if($operation->category)
                                            <td>{{$operation->categories->name}}</td>
                                        @else <td></td>
                                        @endif
                                        @if($operation->payment)
                                            <td>{{$operation->payments->name}}</td>
                                            @else <td></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('operations.show', $operation->id)}}" class="btn btn-primary btn-sm">Voir</a>
                                            <a href="{{ route('operations.edit', $operation->id) }}" class="btn btn-primary btn-sm">Editer</a>
                                            <form class="btn btn-sm" action="{{ route('operations.destroy', $operation->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                                             </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Fin du Tableau -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endsection
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
