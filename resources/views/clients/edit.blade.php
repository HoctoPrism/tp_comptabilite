<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Comptabilite - Editer un client</title>
</head>
<body>
@extends('layout')
@section('content')
<form class="my-5 row" method="POST" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data">
     @csrf
    @method('PATCH')
    <h1 class="text-center col-12">Editer un client</h1>

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

    <div class="mb-3 col-12">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="firstnameHelp" value="{{ $client->firstname }}">
    </div>
    <div class="mb-3 col-12">
        <label for="lastname" class="form-label">Nom</label>
        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="lastnameHelp" value="{{ $client->lastname }}">
    </div>
    <div class="mb-3 col-12">
        <label for="address" class="form-label">Adresse</label>
        <input type="text" class="form-control" name="address" id="address" aria-describedby="addressHelp" value="{{ $client->address }}">
    </div>
    <div class="mb-3 col-12">
        <label for="postal_code" class="form-label">Code postal</label>
        <input type="number" class="form-control" name="postal_code" id="postal_code" aria-describedby="postal_codeHelp" value="{{ $client->postal_code }}">
    </div>
    <div class="mb-3 col-12">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phoneHelp" value="{{ $client->phone }}">
    </div>
    <div class="mb-3 col-12">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="{{ $client->email }}">
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
@endsection
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
