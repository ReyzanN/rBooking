@extends('layouts.app.customers.layouts')

@section('title','Mon compte - Paramètre')

@section('content')
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item">Mon Compte</li>
                <li class="breadcrumb-item active" aria-current="page">Paramètres</li>
            </ol>
        </nav>

        <div>
            <hr>
        </div>

        <div class="row mt-3">
            <div class="bg-body-tertiary w-100 rounded-3"><h4 class="text-capitalize"><i class="bi bi-person-bounding-box"></i>&nbsp;Mes information personnelles</h4></div>
            <div class="row mt-2">
                <div class="col">
                    <ul class="list-group list-group-flush text-uppercase">
                        <li class="list-group-item">Nom</li>
                        <li class="list-group-item">Prénom</li>
                        <li class="list-group-item"><i class="bi bi-envelope-at"></i>&nbsp;Email</li>
                        <li class="list-group-item"><i class="bi bi-telephone"></i>&nbsp;Tél</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ auth()->user()->surname }}</li>
                        <li class="list-group-item">{{ auth()->user()->name }}</li>
                        <li class="list-group-item">{{ auth()->user()->email }}</li>
                        <li class="list-group-item">{{ auth()->user()->phone }}</li>
                    </ul>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <button class="btn btn-outline-warning rounded-4 fw-bold">Modifier mes informations</button>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="bg-body-tertiary w-100 rounded-3"><h4 class="text-capitalize"><i class="bi bi-lock"></i>&nbsp;Sécurité</h4></div>
            <div class="row mt-2">
                <div class="col">
                    <ul class="list-group list-group-flush text-uppercase">
                        <li class="list-group-item">Mot De Passe</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">************</li>
                    </ul>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <button class="btn btn-outline-warning rounded-4 fw-bold">Modifier mon mot de passe</button>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="bg-body-tertiary w-100 rounded-3"><h4 class="text-capitalize"><i class="bi bi-info-circle"></i>&nbsp;Informations</h4></div>
            <div class="row mt-2">
                <div class="col">
                    <ul class="list-group list-group-flush text-uppercase">
                        <li class="list-group-item">Droit du compte</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ auth()->user()->GetRankString() }}</li>
                    </ul>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <button class="btn btn-outline-warning rounded-4 fw-bold">Modifier mon mot de passe</button>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
@endsection
