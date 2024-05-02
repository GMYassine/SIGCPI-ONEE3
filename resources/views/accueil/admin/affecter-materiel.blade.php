@extends('..layouts.accueil')

@section('title','Affecter matériel')

@section('main')
<form class="form border p-3" method="post" action="{{ route('valider-affecter-materiel',$material->codeONEE) }}">
    <div class="mb-3">
        <label for="material" class="form-label">Affecter :</label>
        <input type="text" class="form-control" id="material" value="{{ $material->designation }}" disabled>
    </div>
    <div class="mb-3">
        <label for="agent" class="form-label">Â l'agent :</label>
        <select name="agent" id="agent" class="form-select">
            @forelse ($agents as $oneAgent)
                <option value="{{ $oneAgent->matricule }}">{{ $oneAgent->nomAgent }} {{ $oneAgent->prenomAgent }}</option>
            @empty
                <option value="" disabled selected>No agents available</option>
            @endforelse
        </select>
    </div>
    @csrf
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i>&nbsp;Valider</button>
</form>
@endsection