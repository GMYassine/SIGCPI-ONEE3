@extends('..layouts.accueil')

@section('title','Prendre Decision')

@section('main')
<form class="form border-cosmic p-2" method="post" action="{{ route('valider-prendre-decision',$maintenance->refMaintenance) }}">
    <div class="form-group">
        <label class="my-1">Remarquer</label>
        <textarea name="remarquer" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label class="my-1">Est Remplacé</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="est_remplace" id="oui" value="oui" onclick="enableSelect()">
            <label class="form-check-label" for="oui">
                Oui
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="est_remplace" id="non" value="non" onclick="disableSelect()">
            <label class="form-check-label" for="non">
                Non
            </label>
        </div>
    </div>

    <div class="form-group">
        <label class="my-1">Remplacé Avec</label>
        <select name="remplace_avec" class="form-control" id="remplace_avec" disabled>
            <option value="">Sélectionner...</option>
            @foreach( $materials as $material)
                <option value="{{ $material->codeONEE }}">{{ $material->designation }}</option>
            @endforeach
        </select>
    </div><br>
    
    @csrf
    @foreach($errors->all() as $error )
    <span class="d-block my-2 text-danger"><i class="bi bi-x"></i>{{ $error }}</span>
    @endforeach
    <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-check-lg"></i>&nbsp;Valider</button>
</form>

<script>
    function enableSelect() {
        document.getElementById('remplace_avec').disabled = false;
    }

    function disableSelect() {
        document.getElementById('remplace_avec').disabled = true;
    }
</script>
@endsection