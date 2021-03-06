<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Comptabilite - {{$operation->name}}</title>
</head>
<body>
@extends('layout')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div>Nom du client : <span class="fw-bold">{{$operation->clients->firstname}} {{$operation->clients->lastname}}</span></div>
                <div>Nom de l'opération : <span class="fw-bold">{{$operation->nature}}</span></div>
                <div>Date de l'opération : <span class="fw-bold">{{$operation->date_operation}}</span></div>
                <div>Débit de l'opération : <span class="fw-bold">{{$operation->outcome}}</span></div>
                <div>Crédit de l'opération : <span class="fw-bold">{{$operation->income}}</span></div>
                <div>Catégorie de l'opération : <span class="fw-bold">{{$operation->categories->name}}</span></div>
                <div>Moyen de paiment de l'opération : <span class="fw-bold">{{$operation->payments->name}}</span></div>
                <h1>C'est bien moche</h1>
                <a href="{{ route('operations.index')}}" class="btn btn-primary btn-sm">retour à la liste</a>
            </div>
        </div>
    </div>
    @endsection
    <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
