@extends('..layouts.accueil')

@section('title','Modifier un Agent')

@section('main')
<form class="form border-cosmic p-2" method="POST" action="{{ route('valider-modifier-agent',$oneAgent->matricule) }}">
    @method('PUT')
    <div class="form-group">
        <label class="my-1">Nom</label>
        <input type="text" class="form-control" name="nomAgent" value="{{ $oneAgent->nomAgent }}">
    </div>
    <div class="form-group">
        <label class="my-1">Prénom</label>
        <input type="text" class="form-control" name="prenomAgent" value="{{ $oneAgent->prenomAgent }}">
    </div>
    <div class="form-group">
        <label class="my-1">Emploi</label>
        <input type="text" class="form-control" name="emploiAgent" value="{{ $oneAgent->emploiAgent }}">
    </div>
    <div class="form-group">
        <label class="my-1">Email</label>
        <input type="email" class="form-control" name="emailAgent" value="{{ $oneAgent->emailAgent }}">
    </div>
    <div class="form-group">
        <label class="my-1">Mot de passe</label>
        <div class="input-group">
            <input type="password" class="form-control" name="mot_de_passeAgent" value="{{ $oneAgent->mot_de_passeAgent }}" id="passwordInput">
            <div class="input-group-append">
                <button class="btn btn-secondary rounded-0-left" type="button" id="togglePassword"><i class="bi bi-eye"></i></button>
            </div>
        </div>
    </div>
    <br>
    
    @csrf
    @foreach($errors->all() as $error )
    <span class="d-block my-2 text-danger"><i class="bi bi-x"></i>{{ $error }}</span>
    @endforeach
    <button type="submit" class="btn btn-primary btn-block" id="sub"><i class="bi bi-pencil"></i>&nbsp;Modifier</button>
</form>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
    });
</script>
@endsection