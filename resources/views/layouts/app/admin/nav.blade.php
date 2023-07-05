<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('customer.dashboard') }}"><i class="bi bi-house"></i>&nbsp;Accueil Site</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}"><i class="bi bi-person-lock"></i>&nbsp;Accueil Panel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Rendez-vous | Voir tout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Gestion Type Rendez-vous</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Accès par type
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestion inscrits
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.members.view') }}"><i class="bi bi-people"></i>&nbsp;Voir tout</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.members.suspended.view') }}">Accès compte suspendus</a></li>
                    </ul>
                </li>
            </ul>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <i class="bi bi-person-gear" style="font-size: 1.2rem"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="{{ route('customers.settings') }}"><i class="bi bi-gear"></i>&nbsp;Mon Compte</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('auth.logout') }}"><button class="btn btn-outline-danger">Déconnexion</button></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
