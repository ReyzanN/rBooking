<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('customer.dashboard') }}"><i class="bi bi-house"></i>&nbsp;Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('customers.appointment.history') }}">Mes rendez-vous</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('customers.appointment.type.view') }}">Prendre Rendez-vous</a>
                </li>
            </ul>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <i class="bi bi-person-gear" style="font-size: 1.2rem"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="{{ route('customers.settings') }}"><i class="bi bi-gear"></i>&nbsp;Mon Compte</a></li>
                    @if(auth()->user()->HasRank())
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-person-lock"></i>&nbsp;Panel Gestion</a></li>
                    @endif
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('auth.logout') }}"><button class="btn btn-outline-danger">Déconnexion</button></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
