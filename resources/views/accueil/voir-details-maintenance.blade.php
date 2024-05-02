@extends('..layouts.accueil')

@section('title','Voir détails de maintenance')

@section('main')
<div class="card border-cosmic">
    <div class="card-body">
        <h5 class="card-title text-secondary">Détails de la maintenance du <span class="text-dark">{{$maintenance->material->designation}}</span></h5>
            <p class="card-text">
            <ul>                       
                <li><strong class="text-primary">Date de début de maintenance :</strong><br> {!! $maintenance->dateDebutMaintenance ?: '<span class="text-muted">Non spécifié</span>' !!}</li>
                <li><strong class="text-primary">Raisons principales :</strong><br> {!! $maintenance->raisonsPrincipales ?: '<span class="text-muted">Non spécifié</span>' !!}</li>
                <li><strong class="text-primary">Description :</strong><br>  {!! $maintenance->description ?: '<span class="text-muted">Non spécifié</span>' !!}</li>
                <li><strong class="text-primary">Date de fin de maintenance :</strong><br>  {!! $maintenance->dateFinMaintenance ?: '<span class="text-muted">Non spécifié</span>' !!}</li>
                <li><strong class="text-primary">État :</strong><br>  
                    @if($maintenance->etat == 'en cours')
                        <span class="text-warning"><i class="bi bi-circle-fill"></i>&nbsp;En cours</span>
                    @else
                        <span class="text-success"><i class="bi bi-circle-fill"></i>&nbsp;Fermée</span>
                    @endif
                </li>
                <li><strong class="text-primary">Remarque :</strong><br>  {!! $maintenance->remarquer ?: '<span class="text-muted">Non spécifié</span>' !!}</li>
                <li><strong class="text-primary">Est remplacé :</strong><br>  
                    @if($maintenance->est_remplace == 'true')
                        <span class="text-dark"><i class="bi bi-check-circle-fill"></i>&nbsp;Oui</span>
                    @else
                        <span class="text-dark"><i class="bi bi-x-circle-fill"></i>&nbsp;Non</span>
                    @endif
                </li>
                @if($maintenance->est_remplace == 'true')
                    <li><strong class="text-primary">Remplacé avec :</strong><br><a href="{{ route('voir-details',$maintenance->remplace_avec) }}">{{ $maintenance->remplace_avec_designation }}</a></li>
                @endif
            </ul>
            </p>
    </div>
</div>
@endsection
