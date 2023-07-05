@extends('layouts.app.guest.layouts')

@section('title','404 - Page non trouvée')

@section('content')
    <div class="container mt-5">
        <h4 class="bg-body-tertiary text-capitalize text-center">Cette page ne semble pas exister</h4>
        <p class="text-center mt-5">Cette page, ne semble plus exister, ou elle a été déplacé, si vous pensez que cela est une erreur, contactez votre administrateur</p>
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <a href="{{ route('app.guest') }}"><button class="btn btn-outline-success">Revenir à l'accueil</button></a>
            </div>
        </div>
    </div>
@endsection
