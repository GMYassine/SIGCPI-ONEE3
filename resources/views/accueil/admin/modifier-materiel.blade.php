@extends('layouts.accueil')

@section('title','Modifier le Matériel')

@section('main')
<form class="form border-cosmic p-2" method="POST" action="{{ route('valider-modifier-materiel',$material->codeONEE) }}">
    @method('PUT')
    <div class="form-group">
        <label class="my-1">Sous-Famille</label>
        <select class="form-control" name="sousFamille">
            <option value="Ordinateur & serveur" {{ $material->sousFamille == 'Ordinateur & serveur' ? 'selected' : '' }}>Ordinateur & serveur</option>
            <option value="Impression & Numérisation" {{ $material->sousFamille == 'Impression & Numérisation' ? 'selected' : '' }}>Impression & Numérisation</option>
            <option value="Réseau" {{ $material->sousFamille == 'Réseau' ? 'selected' : '' }}>Réseau</option>
        </select>
    </div>
    <div class="form-group">
        <label class="my-1">Activité</label>
        <input type="text" class="form-control" name="activite" value="{{ $material->activite }}">
    </div>
    <div class="form-group">
        <label class="my-1">Désignation</label>
        <input type="text" class="form-control" name="designation" value="{{ $material->designation }}">
    </div>
    <div class="form-group">
        <label class="my-1">Marque</label>
        <input type="text" class="form-control" name="marque" value="{{ $material->marque }}">
    </div>
    <div class="form-group">
        <label class="my-1">Modèle</label>
        <input type="text" class="form-control" name="modelle" value="{{ $material->modelle }}">
    </div>
    <div class="form-group">
        <label class="my-1">Numéro de Série</label>
        <input type="text" class="form-control" name="numSerie" value="{{ $material->numSerie }}">
    </div>
    <div class="form-group">
        <label class="my-1">Nom et Adresse de Site</label>
        <input type="text" class="form-control" name="NomAdresseSite" value="{{ $material->NomAdresseSite }}">
    </div>
    <div class="form-group">
        <label class="my-1">Contrat d'Acquisition</label>
        <input type="text" class="form-control" name="contratAcquisition" value="{{ $material->contratAcquisition }}">
    </div>
    <div class="form-group">
        <label class="my-1">Objectif</label>
        <input type="text" class="form-control" name="objectif" value="{{ $material->objectif }}">
    </div>
    <div class="form-group">
        <label class="my-1">Année</label>
        <input type="number" class="form-control" max="{{ date('Y') }}" name="annee" value="{{ $material->annee }}">
    </div>
    <div class="form-group">
        <label class="my-1">Titulaire du Marché</label>
        <input type="text" class="form-control" name="titulaireMarche" value="{{ $material->titulaireMarche }}">
    </div><br>

    @csrf
    @foreach($errors->all() as $error )
    <span class="d-block my-2 text-danger"><i class="bi bi-x"></i>{{ $error }}</span>
    @endforeach
    <button type="submit" class="btn btn-primary btn-block" id="sub"><i class="bi bi-pencil"></i>&nbsp;Modifier</button>
</form>
@endsection
