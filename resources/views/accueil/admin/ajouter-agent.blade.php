@extends('layouts.accueil')

@section('title','Ajouter un nouvel Agent')

@section('main')
<form class="form border-cosmic p-2" method="post" action="{{ route('valider-ajouter-agent') }}">
    @csrf
    <div class="form-group">
        <label class="my-1">Nom</label>
        <input type="text" class="form-control" name="nomAgent" value="{{ old('nomAgent') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Prénom</label>
        <input type="text" class="form-control" name="prenomAgent" value="{{ old('prenomAgent') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Emploi</label>
        <input type="text" class="form-control" name="emploiAgent" value="{{ old('emploiAgent') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Email</label>
        <input type="email" class="form-control" name="emailAgent" value="{{ old('emailAgent') }}">
    </div>
    <br>
    <div class="form-group">
        <label class="my-1">Est administrateur</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="statut" id="admin-oui" value="true">
            <label class="form-check-label" for="admin-oui">Oui</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="statut" id="admin-non" value="false">
            <label class="form-check-label" for="admin-non">Non</label>
        </div>
    </div><br>    

    @foreach($errors->all() as $error )
    <span class="d-block my-2 text-danger"><i class="bi bi-x"></i>{{ $error }}</span>
    @endforeach
    <button type="submit" class="btn btn-primary btn-block" id="sub"><i class="bi bi-plus"></i>&nbsp;Ajouter</button>
</form>
@endsection
