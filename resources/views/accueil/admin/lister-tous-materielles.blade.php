@extends('..layouts.accueil')

@section('title','Lister tous les Matérielles')

@section('main')
<h2 class="mb-4 d-flex w-100 justify-content-between">
    <a href="{{ route('ajouter-materiel') }}" class="btn btn-outline-info w-25"><i class="bi bi-plus"></i>&nbsp;Ajouter un nouveau Matériel</a>

    <form method="GET" action="{{ route('rechercher-materiel') }}" class="d-flex w-50">
        <input type="text" class="form-control rounded-0-right" name="designation" 
        @if(request('designation'))value="{{ request('designation') }}"@endif
         placeholder="Chercher un matériel avec désignation">

        <button type="submit" class="btn btn-primary rounded-0-left">Recherche!</button>
    </form>
</h2>
@if(request('search'))<div class="search">↓ Resultats de recherche ↓</div>@endif
<table class="table table-striped border-cosmic">
    <tr>
        <th scope="col">Sous-Famille</th>
        <th scope="col">Désignation</th>
        <th scope="col">Marque</th>
        <th scope="col">Objectif</th>
        <th scope="col">Année</th>
        <th scope="col">Propriété de</th>
        <th scope="col">Statut</th>
        <th scope="col">Action</th>
        <th scope="col"><small class="text-primary text-nowrap">Total ({{ count($materials) }})</small></th>
    </tr>
    @php $materials = $materials->reverse(); @endphp
    @forelse ($materials as $material)
    <tr>
        <td>{{ $material->sousFamille }}</td>
        <td>{{ $material->designation }}</td>
        <td>{{ $material->marque }}</td>
        <td>{{ 	$material->objectif }}</td>
        <td>{{ $material->annee }}</td>
        <td><a href="{{ route('rechercher-agent',['nom'=>$material->agent->nomAgent]) }}">{{ $material->agent->nomAgent }}&nbsp;{{ $material->agent->prenomAgent }}</a></td>
        <td>
            @if($material->statut == 'actif')
                <span class="text-success text-nowrap"><i class="bi bi-circle-fill"></i>&nbsp;actif</span>
            @else
                <span class="text-danger text-nowrap"><i class="bi bi-circle-fill"></i>&nbsp;hors service</span>
            @endif
        </td>
        <td class="w-25">
            <i class="bi bi-caret-down-square" onclick="slideDown(this)"></i>
            <div style="display: none;">
                <a href="{{ route('voir-details',$material->codeONEE) }}"><i class="bi bi-eye"></i>&nbsp;voir details</a><br>
                <a href="{{ route('modifier-materiel',$material->codeONEE) }}" class="text-info"><i class="bi bi-pencil-square"></i>&nbsp;modifier</a><br>
                @if($material->statut == 'actif')
                    <a href="{{ route('change-statut',[$material->codeONEE,'lister-tous-materielles']) }}" onclick="
                    return confirm('es-tu sûr?');
                    " class="text-danger"><i class="bi bi-bug"></i>&nbsp;mettre hors service</a><br>
                @else
                    <a href="{{ route('change-statut',[$material->codeONEE,'lister-tous-materielles']) }}" onclick="
                    return confirm('es-tu sûr?');
                    " class="text-success"><i class="bi bi-arrow-up-circle"></i>&nbsp;remettre en service</a><br>
                @endif
                <a href="{{ route('envoyer-a-maintenance',[$material->codeONEE,'lister-tous-materielles']) }}" class="text-warning"><i class="bi bi-recycle"></i>&nbsp;envoyer à maintenance</a><br>

                @if(!$material->est_affecter)
                    <a href="{{ route('affecter-materiel',$material->codeONEE) }}" class="text-dark"><i class="bi bi-node-plus"></i>&nbsp;affecter matériel</a><br>
                @else
                    <a href="{{ route('detacher-materiel',$material->codeONEE) }}" onclick="
                    return confirm('es-tu sûr?');
                    " class="text-dark"><i class="bi bi-node-minus"></i>&nbsp;détacher matériel</a>
                @endif
                <br>
            </div>
        </td>
        <td colspan="0"></td>
    </tr>
    @empty
    <tr>
        <td colspan="9" class="text-center text-muted">Il n'y a aucune matérial.</td>
    </tr>
    @endforelse
</table>
@endsection