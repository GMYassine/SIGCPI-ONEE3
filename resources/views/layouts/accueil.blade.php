<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assest.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>SIGCPI-ONEE | @yield('title') </title>
</head>
<body>
    <!-- En-tête -->
    @include('..assets.header')
    
    <!-- Success alert -->
    @if(request('success'))
        <div class="alert alert-success alert-dismissible fade show my-2" role="alert" style="border-radius: 10px; padding: 1rem; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <i class="bi bi-check-circle-fill" style="color: #28a745; font-size: 1.2rem;"></i>&nbsp;
            <span style="font-weight: bold;">Succès&nbsp;:&nbsp;</span>
            @if(session('password'))
            {{ "le compte est créé avec succès, le mot de passe :" }}<strong>{{ session('password') }}</strong>
            @else {{ "Le processus s'est terminé avec succès!" }} @endif
            <span style="position: absolute; top: 5px; right: 20px;cursor:pointer" class="display-6" onclick="this.parentElement.remove()">&times;</span>
        </div>    
    @endif

    @if(request('welcome'))
        <div class="alert alert-info alert-dismissible fade show my-2" role="alert" style="border-radius: 10px; padding: 1rem; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <i class="bi bi-info-circle-fill" style="color: #0c5460; font-size: 1.2rem;"></i>&nbsp;
            &nbsp;Bienvenue <span style="font-weight: bold;">{{ $agent->nomAgent }}&nbsp;{{ $agent->prenomAgent }}</span> sur votre plateforme!
            <span style="position: absolute; top: 5px; right: 20px;cursor:pointer" class="display-6" onclick="this.parentElement.remove()">&times;</span>
        </div>
    @endif

    <!-- Contenu Principal -->
    <div class="container-fluid mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="list-group border-cosmic">
                    <a href="{{ route('mise-a-jourer-compte') }}" class="list-group-item list-group-item-action d-flex">
                        <img src="{{ asset('img/profile.png') }}" class="rounded" width="50px" height="50px" alt="profile">
                        <div class="mx-2">
                            <span class="fw-bold">@if($agent->est_admin == 'true')<i class="bi bi-shield-check text-info" title="Administrateur"></i>&nbsp;@endif{{ $agent->nomAgent }}&nbsp;{{ $agent->prenomAgent }}</span>
                            <small class="text-decoration-underline d-block"><i class="bi bi-pencil-square"></i>&nbsp;Mise à jourer compte</small>
                        </div>
                    </a>
                    <a href="{{ route('mon-materielles') }}" class="list-group-item list-group-item-action text-decoration-underline">Mon Matérielles</a>
                    <a href="{{ route('mon-declarations') }}" class="list-group-item list-group-item-action text-decoration-underline">Mon Déclarations</a>
                    @if($agent->est_admin == 'true')
                        <a href="{{ route('consulter-declarations') }}" class="list-group-item list-group-item-action text-decoration-underline">Consulter les Déclarations</a>
                        <a href="{{ route('maintenances-courants') }}" class="list-group-item list-group-item-action text-decoration-underline">Maintenances courants</a>
                        <a href="{{ route('lister-tous-materielles') }}" class="list-group-item list-group-item-action text-decoration-underline">Lister tous les Matérielles</a>
                        <a href="{{ route('lister-tous-agents') }}" class="list-group-item list-group-item-action text-decoration-underline">Lister tous les Agents</a>
                    @endif
                </div>
            </div>
            <!-- Content -->
            <div class="col-md-9 addition">

                <!-- Main Content -->
                @yield('main')

            <!-- Invisible Block -->
            <div class="invisible-block"></div>
            </div>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    @include('assets.footer')

</body>
</html>
