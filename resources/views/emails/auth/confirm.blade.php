@extends('layouts.app.email.layout')

@section('content')
    <div class="container">
        <h5 class="robotoR400">Bonjour {{ $User->name }},</h5>
        <div class="row">
            <p class="mt-3">Pour confirmer votre compte cliquez sur le lien ci dessous</p>
            <a href="{{ route('auth.confirmAccount', $User->confirmToken) }}"><button class="btn btn-success mt-2 mb-2">Confirmer mon compte</button></a>
        </div>
    </div>
@endsection
