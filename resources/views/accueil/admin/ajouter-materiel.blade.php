@extends('..layouts.accueil')

@section('title','Ajouter un nouveau Matériel')

@section('main')
<form class="form border-cosmic p-2" method="post" action="{{ route('valider-ajouter-materiel') }}">
    @csrf

    <div class="form-group">
        <label class="my-1">Sous-famille</label>
        <select class="form-control" name="sousFamille">
            <option value="Ordinateur & serveur" {{ old('sousFamille') == 'Ordinateur & serveur' ? 'selected' : '' }}>Ordinateur & serveur</option>
            <option value="Impression & Numérisation" {{ old('sousFamille') == 'Impression & Numérisation' ? 'selected' : '' }}>Impression & Numérisation</option>
        </select>
    </div>
    <div class="form-group">
        <label class="my-1">Désignation</label>
        <input type="text" class="form-control" name="designation" value="{{ old('designation') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Marque</label>
        <input type="text" class="form-control" name="marque" value="{{ old('marque') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Modèle</label>
        <input type="text" class="form-control" name="modelle" value="{{ old('modelle') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Numéro de série</label>
        <input type="text" class="form-control" name="numSerie" value="{{ old('numSerie') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Contrat d'acquisition</label>
        <input type="text" class="form-control" name="contratAcquisition" value="{{ old('contratAcquisition') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Objectif</label>
        <input type="text" class="form-control" name="objectif" value="{{ old('objectif') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Année</label>
        <input type="number" class="form-control" name="annee" value="{{ old('annee') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Titulaire du marché</label>
        <input type="text" class="form-control" name="titulaireMarche" value="{{ old('titulaireMarche') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Statut</label>
        <select class="form-control" name="statut">
            <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
            <option value="hors service" {{ old('statut') == 'hors service' ? 'selected' : '' }}>Hors service</option>
        </select>
    </div><br>

    @foreach($errors->all() as $error )
    <span class="d-block my-2 text-danger"><i class="bi bi-x"></i>{{ $error }}</span>
    @endforeach
    <button type="submit" class="btn btn-primary btn-block" id="sub"><i class="bi bi-plus"></i>&nbsp;Ajouter</button>
</form>
@endsection
