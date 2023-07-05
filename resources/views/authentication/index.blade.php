@extends('layouts.app.guest.layouts')

@section('title','Création de compte')

@section('content')
    <div class="container mt-3 d-flex justify-content-center align-items-center flex-column">
        <div class="card RegisterCard">
            <div class="d-flex justify-content-center align-items-center">
                <i class="bi bi-person-add" style="font-size: 5rem"></i>
                <h1>Création de Compte</h1>
            </div>
            <div class="card-body">
                @include('layouts.app.common.errors')
                <hr>
                <form action="{{ route('auth.register.confirm') }}" method="post">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="surname" class="form-control" id="surname" placeholder="Martin" value="{{ request()->old('surname') }}">
                                <label for="surname">Nom</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Jean" value="{{ request()->old('name') }}">
                                <label for="name">Prénom</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="jean.martin@gmail.com" value="{{ request()->old('email') }}">
                                <label for="email">Adresse Email</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="tel" name="phone" class="form-control" id="phone" placeholder="0769XXXXXX" maxlength="10" value="{{ request()->old('phone') }}">
                                <label for="phone">Téléphone</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="password" placeholder="MonSuperMotDePasse">
                                <label for="password">Mot De Passe</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-success" type="submit"><i class="bi bi-check2-all"></i>&nbsp;Créer Mon Compte</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('auth.login') }}">J'ai déjà un compte</a>
        </div>
    </div>
@endsection
