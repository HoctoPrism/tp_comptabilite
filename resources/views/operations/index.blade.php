<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Comptabilite - Liste des operations</title>
    @livewireStyles
    @powerGridStyles
</head>
<body>
@extends('layout')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="mx-auto">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="tab-content">
                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <h3>Liste des operations</h3>
                            <a href="{{ route('operations.create')}}" class="btn btn-primary btn-sm">Ajouter</a>
                            @if(session()->get('success'))
                              <div class="alert alert-success">
                                {{ session()->get('success') }}
                              </div><br />
                            @endif
                           <livewire:operation-data-table/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('operations.total') }}">
            @csrf
          <div class="mb-3">
            <label for="total" class="form-label">Date pour calculer le total du mois</label>
            <input type="date" class="form-control" id="total" aria-describedby="totalHelp" name="total">
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

        @if(session()->get('total'))
            @if(session()->get('total') === 'none')
              <div>Aucun résultat pour la période : {{ session()->get('year') }}/{{ session()->get('month') }}</div>
              @else
                <div>le total de la période : {{ session()->get('year') }}/{{ session()->get('month') }} est de : <span class="fw-bold">{{ session()->get('total') }}€</span></div>
            @endif
            <br>
        @endif

    </div>
        @endsection
        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
                crossorigin="anonymous"></script>

        <!-- after -->
        @livewireScripts
        @powerGridScripts

</body>
</html>
