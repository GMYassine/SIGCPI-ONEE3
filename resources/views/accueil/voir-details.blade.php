@extends('layouts.accueil')

@section('title','Voir les détails')

@section('main')  
<div class="card border-cosmic">
    <div class="card-body">
        <h5 class="card-title text-secondary">Détails à propos <span class="text-dark">{{$material->designation}}</span></h5>
            <p class="card-text">
                <table>
                    <tr>
                        <td><strong class="text-primary fw-light">Sous-famille :</strong></td>
                        <td><input type="text" class="px-2" value="{{$material->sousFamille}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Désignation :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->designation}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Activité :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->activite}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Marque :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->marque}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Modele :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->modelle}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Numéro de Série :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->numSerie}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Nom et Adresse de Site :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->NomAdresseSite}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Contrat Acquisition :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->contratAcquisition}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Objectif :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->objectif}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Année :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->annee}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Titulaire Marche :</strong></td>
                        <td><input type="text"  class="px-2"  value="{{$material->titulaireMarche}}" disabled></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary fw-light">Statut :</strong></td>
                        <td>
                            @if($material->statut == 'actif')
                                <input type="text"  class="px-2"  value="Actif" disabled>
                            @else
                                <input type="text"  class="px-2"  value="Hors Service" disabled>
                            @endif
                        </td>
                    </tr>
                </table>                
            </p>
        <a href="{{ route('declarer-probleme',$material->codeONEE) }}" class="text-warning"><i class="bi bi-flag-fill"></i>&nbsp;Déclarer Problème</a>
    </div>
</div>
@endsection
