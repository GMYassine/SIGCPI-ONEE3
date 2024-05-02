@php
    use Illuminate\Support\Facades\Session;
    Session::start();
@endphp
<header>
    <nav class="navbar navbar-light border-bottom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}"><img src="{{ asset('img/logo.png') }}" alt="logo" width="40px">&nbsp;SIGCPI-ONEE</a>
            @if(Session::get('matricule'))
                <div class="ml-auto">
                    <a href="{{ route('deconnexion') }}" class="btn btn-danger mr-2"><i class="bi bi-box-arrow-left"></i>&nbsp;Déconnexion</a>
                </div>
            @endif
        </div>
    </nav>
</header>