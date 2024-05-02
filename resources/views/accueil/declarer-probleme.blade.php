@extends('layouts.accueil')

@section('title','Déclarer un problème')

@section('main')    
<form method="post" action="{{ route('valider-declarer-probleme',$material->codeONEE) }}" class="border-cosmic p-2">
    <h2 class="mb-4 text-secondary">Déclarer un problème à propos <span class="text-dark">{{ $material->designation }}</span></h2>

    @if($material->sousFamille === 'Ordinateur & serveur')

    <div class="form-check">
        <input class="form-check-input" type="radio" name="computer_issue" id="fan_issue" value="fan_issue">
        <label class="form-check-label" for="fan_issue">
            Le ventilateur de l'unité centrale ne fonctionne pas correctement 
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="computer_issue" id="startup_error" value="startup_error">
        <label class="form-check-label" for="startup_error">
            L'ordinateur affiche des erreurs de démarrage
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="computer_issue" id="motherboard_damage" value="motherboard_damage">
        <label class="form-check-label" for="motherboard_damage">
            La carte mère semble être endommagée
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="computer_issue" id="autre" value="autre" checked>
        <label class="form-check-label" for="autre">
            Autre
        </label>
    </div>

    @else
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="screen_issue" id="dead_pixels" value="dead_pixels">
        <label class="form-check-label" for="dead_pixels">
            L'écran présente des pixels morts ou défectueux
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="screen_issue" id="distorted_lines" value="distorted_lines">
        <label class="form-check-label" for="distorted_lines">
            Il y a des lignes ou des distorsions sur l'affichage 
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="screen_issue" id="no_display" value="no_display">
        <label class="form-check-label" for="no_display">
            L'écran ne s'allume pas du tout
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="screen_issue" id="autre" value="autre" checked>
        <label class="form-check-label" for="autre">
            Autre
        </label>
    </div>
    
    @endif
    
    <div class="form-group my-2">
      <textarea class="form-control" maxlength="200" name="description" cols="10" rows="5" placeholder="Saisir plus des détails (limite : 200 caractères)"></textarea>
    </div><br>
    @csrf
    @foreach($errors->all() as $error )
    <span class="d-block my-2 text-danger"><i class="bi bi-x"></i>{{ $error }}</span>
    @endforeach
    <button type="submit" class="btn btn-warning btn-block"><i class="bi bi-check-lg"></i>&nbsp;Valider</button>
  </form>
@endsection