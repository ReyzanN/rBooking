@extends('layouts.app.email.layout')

@section('content')
    <div>
        <h5>Bonjour {{ $Name }},</h5>
        <div>
            <p>Email associé : {{ $Email }}</p>
            <p>Vous avez demandé de réinitialiser votre mot de passe suivez les instructions du lien ci-dessous</p>
            <a href="{{ route('password.setnew', $Token) }}"><button>Réinitialiser mon mot de passe</button></a>
        </div>
    </div>
@endsection
