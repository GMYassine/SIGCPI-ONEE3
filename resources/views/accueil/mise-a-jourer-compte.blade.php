@extends('layouts.accueil')

@section('title','Mise à jourer le compte')

@section('main')
<form class="form border-cosmic p-2" method="post" action="{{ route('valider-informations-compte') }}">
    <div class="form-group">
      <label class="my-1">Nom</label>
      <input type="text" class="form-control" value="{{ $agent->nomAgent }}" disabled>
    </div>
    <div class="form-group">
        <label class="my-1">Prenom</label>
        <input type="text" class="form-control" value="{{ $agent->prenomAgent }}" disabled>
    </div>
    <div class="form-group">
        <label class="my-1">Emploi</label>
        <input type="text" class="form-control" value="{{ $agent->emploiAgent }}" disabled>
    </div>
    <div class="form-group">
        <label class="my-1">Email</label>
        <input type="text" class="form-control" value="{{ $agent->emailAgent }}" disabled>
    </div>
    <div class="form-group">
        <label class="my-1">Entité</label>
        <input type="text" class="form-control" value="{{ $entite->nomEntite }}" disabled>
    </div>
    <div class="form-group">
        <label class="my-1">Mot de passe actuel</label>
        <input type="password" class="form-control" name="motDePassAC">
    </div>
    <div class="form-group">
        <label class="my-1">Nouveau mot de passe</label>
        <input type="password" class="form-control" name="motDePass" id="motDePass">
        <div id="password-strength">
            <span class="d-block my-2 text-muted"><i class="bi bi-check"></i>Minimum 8 caractères</span>
            <span class="d-block my-2 text-muted"><i class="bi bi-check"></i>Au moins une lettre majuscule</span>
            <span class="d-block my-2 text-muted"><i class="bi bi-check"></i>Au moins une lettre minuscule</span>
            <span class="d-block my-2 text-muted"><i class="bi bi-check"></i>Au moins un chiffre</span>
            <span class="d-block my-2 text-muted"><i class="bi bi-check"></i>Au moins un caractère spécial</span>
        </div>
    </div>
    <div class="form-group">
      <label class="my-1">Répété le nouveau mot de passe</label>
      <input type="password" class="form-control" name="ReMotDePass" oninput="
        if(document.getElementById('motDePass').value != this.value){
            this.style.outline = '1px solid red';
        }else{
            this.style.outline = 'none';
        }
      ">
    </div><br>
    @csrf
    @foreach($errors->all() as $error )
    <span class="d-block my-2 text-danger"><i class="bi bi-x"></i>{{ $error }}</span>
    @endforeach
    <button type="submit" class="btn btn-primary btn-block" id="sub"><i class="bi bi-check-lg"></i>&nbsp;Valider</button>
</form>
@endsection