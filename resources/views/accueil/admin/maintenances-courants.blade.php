@extends('layouts.accueil')

@section('title','Maintenances courantes')

@section('main')
@if(request('search'))<div class="search">↓ Résultats de recherche ↓</div>@endif
<table class="table table-striped border-cosmic">
    <tr>
        <th scope="col">Référence</th>
        <th scope="col">Matériel</th>
        <th scope="col">Date de début</th>
        <th scope="col">Date de fin</th>
        <th scope="col">Statut</th>
        <th scope="col">Action</th>
        <th scope="col"><small class="text-primary text-nowrap">Total ({{ count($maintenances) }})</small></th>
    </tr>
    @php $maintenances = $maintenances->reverse(); @endphp
    @forelse ($maintenances as $maintenance)
    <tr>
        <td>{{ $maintenance->refMaintenance }}</td>
        <td><a href="{{ route('rechercher-materiel',['designation'=>$maintenance->material->designation]) }}">{{ $maintenance->material->designation }}</a></td>
        <td>{{ $maintenance->dateDebutMaintenance }}</td>
        <td>{{ $maintenance->dateFinMaintenance }}</td>
        <td>
            @if($maintenance->etat == 'en cours')
                <span class="text-bold"><i class="bi bi-clock-fill"></i>&nbsp;En cours</span>
            @else
                <span class="text-bold"><i class="bi bi-check-circle-fill"></i>&nbsp;Clôturé</span>
            @endif
        </td>
        <td>
            <a href="{{ route('voir-details-maintenance',$maintenance->refMaintenance) }}" class="text-nowrap"><i class="bi bi-eye"></i>&nbsp;Voir détails</a><br>
            @if($maintenance->etat == 'en cours')
                <a href="{{ route('prendre-decision',$maintenance->refMaintenance) }}" class="text-dark text-nowrap"><i class="bi bi-clipboard-check"></i>&nbsp;Prendre décision</a>
            @endif
        </td>
        <td></td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center text-muted">Il n'y a aucune maintenance.</td>
    </tr>
    @endforelse
</table>
@endsection
