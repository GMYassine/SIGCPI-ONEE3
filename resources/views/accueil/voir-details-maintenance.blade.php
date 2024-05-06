@extends('layouts.accueil')

@section('title','Voir Détails de Maintenance')

@section('main')
<div class="card border-cosmic">
    <div class="card-body">
        <h5 class="card-title text-secondary">Détails de la Maintenance du <span class="text-dark">{{$maintenance->material->designation}}</span></h5>
            <p class="card-text">
                <table>
                    <tr>
                        <td><strong class="text-primary fw-light">Date de Début de Maintenance :</strong></td>
                        <td><input type="text" class="px-2" value="{{ $maintenance->dateDebutMaintenance ?: 'Non Spécifié' }}" class="form-control form-control-sm" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Raisons Principales :</strong></td>
                        <td><input type="text" class="px-2" value="{{ $maintenance->raisonsPrincipales ?: 'Non Spécifié' }}" class="form-control form-control-sm" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Description :</strong></td>
                        <td><input type="text" class="px-2" value="{{ $maintenance->description ?: 'Non Spécifié' }}" class="form-control form-control-sm" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Date de Fin de Maintenance :</strong></td>
                        <td><input type="text" class="px-2" value="{{ $maintenance->dateFinMaintenance ?: 'Non Spécifié' }}" class="form-control form-control-sm" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Statut :</strong></td>
                        <td>
                            @if($maintenance->etat == 'en cours')
                                <input type="text" class="px-2" value="En Cours" class="form-control form-control-sm text-warning" disabled>
                            @else
                                <input type="text" class="px-2" value="Cloturé" class="form-control form-control-sm text-success" disabled>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Remarque :</strong></td>
                        <td><input type="text" class="px-2" value="{{ $maintenance->remarquer ?: 'Non Spécifié' }}" class="form-control form-control-sm" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Est Réparé :</strong></td>
                        <td>
                            @if($maintenance->est_remplace == 'false')
                                <input type="text" class="px-2" value="Oui" class="form-control form-control-sm text-dark" disabled>
                            @else
                                <input type="text" class="px-2" value="Non" class="form-control form-control-sm text-dark" disabled>
                            @endif
                        </td>
                    </tr>
                    @if($maintenance->est_remplace == 'true')
                        <tr>
                            <td><strong class="text-primary fw-light">Remplacé avec :</strong></td>
                            <td><a href="{{ route('voir-details',$maintenance->remplace_avec) }}">{{ $maintenance->remplace_avec_designation }}</a></td>
                        </tr>
                    @endif
                </table>                
            </p>
    </div>
</div>
@endsection
