@extends('layouts.app.customers.layouts')

@section('title','Me connecter')

@section('content')
    <div class="container mt-3 d-flex justify-content-center align-items-center">
        <div class="card" style="width: 35rem;">
            <div class="d-flex justify-content-center align-items-center">
                <i class="bi bi-person-add" style="font-size: 5rem"></i>
                <h1>Se Connecter</h1>
            </div>
            <div class="card-body">
                @include('layouts.app.common.errors')
                <hr>
                <form action="{{ route('auth.login.confirm') }}" method="post">
                    @csrf

                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="jean.martin@gmail.com" value="{{ request()->old('email') }}">
                                <label for="email">Adresse Email</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="password" placeholder="MonSuperMotDePasse">
                                <label for="password">Mot De Passe</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-success" type="submit"><i class="bi bi-check2-all"></i>&nbsp;Me Connecter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
