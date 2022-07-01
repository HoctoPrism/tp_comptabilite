<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Comptabilite - Créer un client</title>
</head>
<body>
@extends('layout')
@section('content')
<form class="my-5 row" method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data">
     @csrf
    <h1 class="text-center col-12">Ajouter un client</h1>

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
        <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="firstnameHelp">
    </div>
    <div class="mb-3 col-12">
        <label for="lastname" class="form-label">Nom</label>
        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="lastnameHelp">
    </div>
    <div class="mb-3 col-12">
        <label for="address" class="form-label">Adresse</label>
        <input type="text" class="form-control" name="address" id="address" aria-describedby="addressHelp">
    </div>
    <div class="mb-3 col-12">
        <label for="postal_code" class="form-label">Code postal</label>
        <input type="number" class="form-control" name="postal_code" id="postal_code" aria-describedby="postal_codeHelp">
    </div>
    <div class="mb-3 col-12">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phoneHelp">
    </div>
    <div class="mb-3 col-12">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
@endsection
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
