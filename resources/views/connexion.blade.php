<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assest.css') }}">
    <title>SIGCPI-ONEE | Connexion</title>
</head>
<body>
    <!-- En-tête -->
    @include('assets.header')
      
    <!-- Contenu Principal -->
    <div class="container mt-5" style="height: 100vh">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card border-cosmic">
                    <div class="card-body">
                        <!-- Titre du formulaire -->
                        <h2 class="card-title text-center">Connexion</h2>

                        <!-- Formulaire de connexion -->
                        <form method="post" action="{{ route('connexion') }}">

                            <!-- Champ de saisie de l'email -->
                            <div class="form-group">
                                <label for="email" class="my-1">Matricule d'utilisateur</label>
                                <input type="text" class="form-control" name="matricule" value="{{ old('matricule') }}" placeholder="Entrer votre matricule">
                            </div>

                            <!-- Champ de saisie du mot de passe -->
                            <div class="form-group">
                                <label for="password" class="my-1">Mot de passe</label>
                                <input type="password" class="form-control" name="password" placeholder="Entrer votre mot de passe">
                            </div>

                            <!-- Jeton CSRF -->
                            @csrf

                            <!-- errors -->
                            @foreach($errors->all() as $error )
                            <span class="d-block my-2 text-danger"><i class="bi bi-x"></i>{{ $error }}</span>
                            @endforeach

                            <!-- Bouton de soumission -->
                            <button type="submit" class="btn btn-primary btn-block mt-4 mx-auto d-block">Connexion</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
      
    <!-- Pied de page -->
    @include('assets.footer')

</body>
</html>