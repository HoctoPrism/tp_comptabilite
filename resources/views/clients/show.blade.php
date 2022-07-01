<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Comptabilite - {{$client->name}}</title>
</head>
<body>
@extends('layout')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div>Prénom : <span class="fw-bold">{{$client->firstname}}</span></div>
                <div>Nom : <span class="fw-bold">{{$client->lastname}}</span></div>
                <div>Adresse : <span class="fw-bold">{{$client->address}}</span></div>
                <div>Code postal : <span class="fw-bold">{{$client->postal_code}}</span></div>
                <div>Téléphone : <span class="fw-bold">{{$client->phone}}</span></div>
                <div>Email : <span class="fw-bold">{{$client->email}}</span></div>
                <a href="{{ route('clients.index')}}" class="btn btn-primary btn-sm">retour à la liste</a>
            </div>
        </div>
    </div>
    @endsection
    <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
