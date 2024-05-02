@extends('..layouts.accueil')

@section('title','Maintenances courants')

@section('main')
<table class="table table-striped border-cosmic">
    <tr>
        <th scope="col">Réference</th>
        <th scope="col">Matérial</th>
        <th scope="col">Date de début</th>
        <th scope="col">Date de fin</th>
        <th scope="col">Etat</th>
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
                <span class="text-bold"><i class="bi bi-clock-fill"></i>&nbsp;en cours</span>

            @else
                <span class="text-bold"><i class="bi bi-check-circle-fill"></i>&nbsp;fermée</span>
                
            @endif
        </td>
        <td>
            <a href="{{ route('voir-details-maintenance',$maintenance->refMaintenance) }}" class="text-nowrap"><i class="bi bi-eye"></i>&nbsp;voir details</a><br>
            @if($maintenance->etat == 'en cours')
                <a href="{{ route('prendre-decision',$maintenance->refMaintenance) }}" class="text-dark text-nowrap"><i class="bi bi-clipboard-check"></i>&nbsp;prendre décision</a>
            @endif
            <br>
        </td>
        <td colspan="0"></td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center text-muted">Il n'y a aucune maintenance.</td>
    </tr>
    @endforelse
</table>
@endsection