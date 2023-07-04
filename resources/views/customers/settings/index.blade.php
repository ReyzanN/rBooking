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
            @include('layouts.app.common.errors')
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
                    <button class="btn btn-outline-warning rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#PersonalInformations">Modifier mes informations</button>
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

        <!-- Modal -->
            <!-- Modal Personal Information -->
            <div class="modal modal-lg fade" id="PersonalInformations" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="PersonalInformationsLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="PersonalInformationsLabel">Modifier Mes Informations Personnelles</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('customers.settings.update.informations') }}" method="post">
                                @csrf
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="surname" class="form-control" id="surname" placeholder="Martin" value="@if(request()->old('surname')) {{ request()->old('surname') }}@else {{ auth()->user()->surname }} @endif">
                                            <label for="surname">Nom</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Jean" value="@if(request()->old('name')) {{ request()->old('name') }}@else {{ auth()->user()->name }} @endif">
                                            <label for="name">Prénom</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="jean.martin@gmail.com" value="@if(request()->old('email')) {{ request()->old('email') }}@else {{ auth()->user()->email }} @endif">
                                            <label for="email">Adresse Email</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="tel" name="phone" class="form-control" id="phone" placeholder="0769XXXXXX" maxlength="10" value="@if(request()->old('phone')) {{ request()->old('phone') }}@else {{ auth()->user()->phone }} @endif">
                                            <label for="phone">Téléphone</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2 d-flex justify-content-center align-items-center">
                                    <button class="btn btn-success w-75">Modifier mes informations</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection

@section('script')
@endsection
