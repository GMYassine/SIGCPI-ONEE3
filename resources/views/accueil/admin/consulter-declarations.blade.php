@extends('layouts.accueil')

@section('title','Consulter les Déclarations')

@section('main')
<table class="table table-striped border-cosmic">
    <tr>
        <th scope="col">Numéro de Déclaration</th>
        <th scope="col">Raisons Principales</th>
        <th scope="col">Auteur</th>
        <th scope="col">Description</th>
        <th scope="col">Matérial</th>
        <th scope="col">Date</th>
        <th scope="col">Statut</th>  
        <th scope="col">Action</th>
        <th scope="col"><small class="text-primary text-nowrap">Total ({{ count($declarations) }})</small></th>
    </tr>
    @php $declarations = $declarations->reverse(); @endphp
    @forelse ($declarations as $declaration)
    <tr>
        <td>{{ $declaration->refDeclaration }}</td>
        <td>{{ $declaration->raisonsPrincipales }}</td>
        <td><a href="{{ route('rechercher-agent',['nom'=>$declaration->agent->nomAgent]) }}">{{ $declaration->agent->nomAgent }}&nbsp;{{ $declaration->agent->prenomAgent }}</a></td>
        <td class="text-break">{{ $declaration->description }}</td>
        <td><a href="{{ route('rechercher-materiel',['designation'=>$declaration->material->designation]) }}">{{ $declaration->material->designation }}</a></td>
        <td class="text-nowrap">{{ $declaration->dateDeclaration }}</td>
        <td class="text-nowrap" >
            @if($declaration->est_ferme == 'false')
            <span class="text-bold"><i class="bi bi-folder2-open"></i>&nbsp;Ouvrir</span>

            @else
            <span class="text-bold"><i class="bi bi-folder2"></i>&nbsp;Cloturé</span>

            @endif
        </td>
        <td>
            @if($declaration->est_ferme == 'false')
                <a href="{{ route('envoyer-a-maintenance',[$declaration->material->codeONEE,'consulter-declarations',$declaration->refDeclaration]) }}" class="text-warning text-nowrap"><i class="bi bi-recycle"></i>&nbsp;Envoyer à Maintenance</a><br>

            @else
                @if($declaration->is_maintenance)
                    <a href="{{ route('rechercher-maintenance',$declaration->refMaintenance) }}" class="text-primary text-nowrap"><i class="bi bi-search"></i>&nbsp;Voir Maintenance</a><br>
                @endif
            @endif
        </td>
        <td colspan="0"></td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="text-center text-muted">Il n'y a aucune Déclaration.</td>
    </tr>
    @endforelse
</table>
@endsection
