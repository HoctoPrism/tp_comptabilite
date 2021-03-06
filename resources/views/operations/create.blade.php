<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Comptabilite - Créer une opération</title>
</head>
<body>
@extends('layout')
@section('content')
<form class="my-5 row" method="POST" action="{{ route('operations.store') }}" enctype="multipart/form-data">
     @csrf
    <h1 class="text-center col-12">Ajouter une opération</h1>

    <!-- Message d'information -->
    @if ($errors->any())
      <div class="alert alert-danger">
       <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
       </ul>
      </div>
    @endif

    <div class="mb-3 col-6">
        <label for="client" class="form-label">Client</label>
        <select class="form-select" name="client" id="client" aria-describedby="clientHelp">
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->firstname }} {{ $client->lastname }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3 col-12">
        <label for="nature" class="form-label">Nature de l'opération</label>
        <input type="text" class="form-control" name="nature" id="nature" aria-describedby="natureHelp">
    </div>
    <div class="mb-3 col-12">
        <label for="date_operation" class="form-label">Date de l'opération</label>
        <input type="date" class="form-control" name="date_operation" id="date_operation" aria-describedby="date_operationHelp">
    </div>
    <div class="mb-3 col-12">
        <label for="outcome" class="form-label">Débit</label>
        <input type="number"  step=".01" class="form-control" name="outcome" id="outcome" aria-describedby="outcomeHelp">
    </div>
    <div class="mb-3 col-12">
        <label for="income" class="form-label">Crédit</label>
        <input type="number"  step=".01" class="form-control" name="income" id="income" aria-describedby="incomeHelp">
    </div>
    <div class="mb-3 col-6">
        <label for="category" class="form-label">catégorie de l'opération</label>
        <select class="form-select" name="category" id="category" aria-describedby="categoryHelp">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3 col-6">
        <label for="payment" class="form-label">Type de paiement</label>
        <select class="form-select" name="payment" id="payment" aria-describedby="paymentHelp">
            @foreach($payments as $payment)
                <option value="{{ $payment->id }}">{{ $payment->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
@endsection
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
