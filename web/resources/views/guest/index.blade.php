@extends('layouts.app.guest.layouts')

@section('title','Système de réservation')

@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-center align-items-center flex-column mt-3">
            <h1 class="robotoR400">{{ env('APP_NAME') }}</h1>
            <p>Bonjour, bienvenue sur votre outil de prise de rendez-vous</p>
        </div>
        <hr>
        <div class="mt-1">
            <div class="row">
                <div class="col-6 d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-phone-vibrate" style="font-size: 5rem"></i>
                    <p class="text-center">Un outil pour faciliter la prise de vos rendez-vous avec vos interlocuteurs, tout se passe ici, sur votre téléphone, ou votre ordinateur !</p>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-person-video3" style="font-size: 5rem"></i>
                    <p class="text-center">Un outil, pour prendre des rendez-vous de tout type, avec vos interlocuteurs</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="mt-1">
            <h3 class="text-center">Prendre rendez-vous</h3>
            <div class="row">
                <div class="col-6 d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-person-dash" style="font-size: 3rem"></i>
                    <p class="text-center">Je n'ai pas de compte</p>
                    <a href="{{ route('auth.register') }}"><button class="btn btn-success rounded-2">Créer mon compte</button></a>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-person-check" style="font-size: 3rem"></i>
                    <p class="text-center">J'ai un compte</p>
                    <a href="{{ route('auth.login') }}"><button class="btn btn-success rounded-2">Me connecter</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
