@extends('layouts.accueil')

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
        <label class="my-1">Activité</label>
        <input type="text" class="form-control" name="activite" value="{{ old('activite') }}">
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
        <label class="my-1">Nom et Adresse de Site</label>
        <input type="text" class="form-control" name="NomAdresseSite" value="{{ old('NomAdresseSite') }}">
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
        <input type="number" class="form-control" max="{{ date('Y') }}" name="annee" value="{{ old('annee') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Titulaire du marché</label>
        <input type="text" class="form-control" name="titulaireMarche" value="{{ old('titulaireMarche') }}">
    </div>
    <div class="form-group">
        <label class="my-1">Statut</label><br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="statut" id="statut_actif" checked value="actif" {{ old('statut') == 'actif' ? 'checked' : '' }}>
            <label class="form-check-label" for="statut_actif">Actif</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="statut" id="statut_hors_service" value="hors service" {{ old('statut') == 'hors service' ? 'checked' : '' }}>
            <label class="form-check-label" for="statut_hors_service">Hors service</label>
        </div>
    </div><br>    

    <div class="mb-3">
        <label for="agent" class="form-label">Affecter à :</label>
        <select name="agent" id="agent" class="form-select">
            @forelse ($agents as $oneAgent)
                <option value="{{ $oneAgent->matricule }}">{{ $oneAgent->nomAgent }} {{ $oneAgent->prenomAgent }}</option>
            @empty
                <option value="" disabled selected>No agents available</option>
            @endforelse
        </select>
    </div>

    @foreach($errors->all() as $error )
    <span class="d-block my-2 text-danger"><i class="bi bi-x"></i>{{ $error }}</span>
    @endforeach
    <button type="submit" class="btn btn-primary btn-block" id="sub"><i class="bi bi-plus"></i>&nbsp;Ajouter</button>
</form>
@endsection
