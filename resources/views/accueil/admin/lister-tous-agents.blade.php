@extends('..layouts.accueil')

@section('title','Lister tous les Agents')

@section('main')
<h2 class="mb-4 d-flex w-100 justify-content-between">
    <a href="{{ route('ajouter-agent') }}" class="btn btn-outline-info w-25"><i class="bi bi-plus"></i>&nbsp;Ajouter un nouveau Agent</a>

    <form method="GET" action="{{ route('rechercher-agent') }}" class="d-flex w-50">
        <input type="text" class="form-control rounded-0-right" name="nom"
        @if(request('nom'))value="{{ request('nom') }}"@endif
         placeholder="Chercher un agent avec nom">

        <button type="submit" class="btn btn-primary rounded-0-left">Recherche!</button>
    </form>
</h2>
@if(request('search'))<div class="search">↓ Resultats de recherche ↓</div>@endif
<table class="table table-striped border-cosmic">
    <tr>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">Empoi</th>
        <th scope="col">Email</th>
        <th scope="col">Mot de pass</th> 
        <th scope="col">Action</th>
        <th scope="col"><small class="text-primary text-nowrap">Total ({{ count($agents) }})</small></th>
    </tr>
    @php $agents = $agents->reverse(); @endphp
    @forelse ($agents as $oneAgent)
    <tr>
        <td>{{ $oneAgent->nomAgent }}</td>
        <td>{{ $oneAgent->prenomAgent }}</td>
        <td>{{ $oneAgent->emploiAgent }}</td>
        <td>{{ $oneAgent->emailAgent }}</td>
        <td>
            <div class="position-relative border">
                <input type="password" class="border-0 passwordInput m-0 me-2" disabled value="{{ $oneAgent->mot_de_passeAgent }}">
                <i class="bi bi-eye togglePasswordBtn position-absolute" style="top: 50%; transform: translateY(-50%); right: 10px;"></i>
            </div>
        </td>        
        <td>
            <a href="{{ route('rechercher-materiel',['matricule'=>$oneAgent->matricule]) }}" class="text-nowrap"><i class="bi bi-eye"></i>&nbsp;voir les materielles</a><br>
            <a href="{{ route('manager-suspender-agent',$oneAgent->matricule) }}" onclick="return confirm('es-tu sûr?');" class="text-{{ $oneAgent->est_suspender == 'true' ? 'success' : 'danger' }} text-nowrap"><i class="bi bi-{{ $oneAgent->est_suspender == 'true' ? 'slash-circle' : 'ban' }}"></i>&nbsp;{{ $oneAgent->est_suspender == 'true' ? 'réactiver compte' : 'suspender compte' }}</a><br>
            <a href="{{ route('modifier-agent',$oneAgent->matricule) }}" class="text-info text-nowrap"><i class="bi bi-pencil-square"></i>&nbsp;modifier les informations</a><br>    
        </td>
        <td colspan="0"></td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center text-muted">Il n'y a aucun agent.</td>
    </tr>
    @endforelse
</table>
<script>
    function togglePassword(button) {
        const passwordInput = button.previousElementSibling;
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        (type === 'password')? button.classList.replace('bi-eye-slash','bi-eye') : button.classList.replace('bi-eye','bi-eye-slash');
    }

    document.addEventListener("DOMContentLoaded", function() {
        const togglePasswordBtns = document.querySelectorAll('.togglePasswordBtn');

        togglePasswordBtns.forEach(function(button) {
            button.addEventListener('click', function() {
                togglePassword(button);
            });
        });
    });
</script>
@endsection