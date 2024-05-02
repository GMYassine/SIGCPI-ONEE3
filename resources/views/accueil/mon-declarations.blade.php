@extends('layouts.accueil')

@section('title','Mon Déclarations')

@section('main')
<table class="table table-striped border-cosmic">
    <tr>
        <th scope="col">Numéro de déclaration</th>
        <th scope="col">Raisons principales</th>
        <th scope="col">Description</th>
        <th scope="col">Matérial</th>
        <th scope="col">Date</th>
        <th scope="col">Action</th>
        <th scope="col"><small class="text-primary text-nowrap">Total ({{ count($declarations) }})</small></th>
    </tr>
    @php $declarations = $declarations->reverse(); @endphp
    @forelse ($declarations as $declaration)
    <tr>
        <td>{{ $declaration->refDeclaration }}</td>
        <td>{{ $declaration->raisonsPrincipales }}</td>
        <td class="text-break">{{ $declaration->description }}</td>
        <td><a href="{{ route('voir-details',$declaration->material->codeONEE) }}">{{ $declaration->material->designation }}</a></td>
        <td class="text-nowrap">{{ $declaration->dateDeclaration }}</td>
        <td>
            @if($declaration->est_ferme == 'true' && $declaration->is_maintenance )
                <a href="{{ route('voir-details-maintenance',$declaration->refMaintenance) }}" class="text-primary text-nowrap"><i class="bi bi-eye"></i>&nbsp;voir maintenance</a><br>
            @else
                <span class="text-muted text-nowrap text-decoration-underline"><i class="bi bi-clock-history"></i>&nbsp;en cours de traitement</span>
            @endif
        </td>
        <td colspan="0"></td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center text-muted">Il n'y a aucune déclaration.</td>
    </tr>
    @endforelse
</table>
@endsection