@extends('layouts.app.guest.layouts')

@section('title', 'Mot de passe oublié')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            @include('layouts.app.common.errors')
        </div>
        <div class="text-center d-flex justify-content-center">
            <div class="card" style="width: 30rem;">
                <i class="bi bi-key-fill" style="font-size: 7rem"></i>
                <div class="card-body">
                    <h5 class="card-title">Mot de passe oublié</h5>
                    <p class="card-text">Renseignez votre adresse email si elle existe vous allez recevoir un lien de ré-initialisation de mot de passe.</p>
                    <form action="{{ route('password.redeemConfirm') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                            <label for="email">Adresse email</label>
                        </div>
                        <button type="submit" class="btn btn-success">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
