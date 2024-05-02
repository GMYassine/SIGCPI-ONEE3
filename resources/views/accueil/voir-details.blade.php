@extends('layouts.accueil')

@section('title','Voir les détails')

@section('main')  
<div class="card border-cosmic">
    <div class="card-body">
        <h5 class="card-title text-secondary">Détails à propos <span class="text-dark">{{$material->designation}}</span></h5>
            <p class="card-text">
            <ul>                       
                <li><strong class="text-primary">sous Famille :</strong> {{$material->sousFamille}}</li>
                <li><strong class="text-primary">designation :</strong> {{$material->designation}}</li>
                <li><strong class="text-primary">marque :</strong>  {{$material->marque}}</li>
                <li><strong class="text-primary">modele :</strong>  {{$material->modelle}}</li>
                <li><strong class="text-primary">numéro Serie :</strong>  {{$material->numSerie}}</li>
                <li><strong class="text-primary">contrat Acquisition :</strong>  {{$material->contratAcquisition}}</li>
                <li><strong class="text-primary">objectif :</strong>  {{$material->objectif}}</li>
                <li><strong class="text-primary">année :</strong>  {{$material->annee}}</li>
                <li><strong class="text-primary">titulaire Marche :</strong>  {{$material->titulaireMarche}}</li>
                <li><strong class="text-primary">statut : </strong>
                    @if($material->statut == 'actif')
                        <span class="text-success"><i class="bi bi-circle-fill"></i>&nbsp;actif</span>
                    @else
                        <span class="text-danger"><i class="bi bi-circle-fill"></i>&nbsp;hors service</span>
                    @endif
                </li>
            </ul>
            </p>
        <a href="{{ route('declarer-probleme',$material->codeONEE) }}" class="text-warning"><i class="bi bi-flag-fill"></i>&nbsp;déclarer problème</a>
    </div>
</div>
@endsection