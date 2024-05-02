@extends('layouts.accueil')

@section('title','Mon Matérielles')

@section('main')
<table class="table table-striped border-cosmic">
    <tr>
        <th scope="col">Sous-Famille</th>
        <th scope="col">Désignation</th>
        <th scope="col">Marque</th>
        <th scope="col">Objectif</th>
        <th scope="col">Année</th>
        <th scope="col">Statut</th>
        <th scope="col">Action</th>
        <th scope="col"><small class="text-primary text-nowrap">Total ({{ count($materielles) }})</small></th>
    </tr>
    @php $materielles = $materielles->reverse(); @endphp
    @forelse ($materielles as $material)
    <tr>
        <td>{{ $material->sousFamille }}</td>
        <td>{{ $material->designation }}</td>
        <td>{{ $material->marque }}</td>
        <td>{{ 	$material->objectif }}</td>
        <td>{{ $material->annee }}</td>
        <td>
            @if($material->statut == 'actif')
                <span class="text-success text-nowrap"><i class="bi bi-circle-fill"></i>&nbsp;actif</span>
            @else
                <span class="text-danger text-nowrap"><i class="bi bi-circle-fill"></i>&nbsp;hors service</span>
            @endif
        </td>
        <td>
            <a href="{{ route('voir-details',$material->codeONEE) }}"><i class="bi bi-eye"></i>&nbsp;voir details</a><br>
            <a href="{{ route('declarer-probleme',$material->codeONEE) }}" class="text-warning text-nowrap"><i class="bi bi-flag-fill"></i>&nbsp;déclarer problème</a>
        </td>

        <td colspan="0"></td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="text-center text-muted">Il n'y a aucun matériel.</td>
    </tr>
    @endforelse
</table>
@endsection