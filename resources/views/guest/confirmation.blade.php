@extends('layouts.app.guest.layouts')

@section('title','Confirmation de rendez-vous')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            @include('layouts.app.common.errors')
        </div>
        <div class="mt-3">
            @if(auth()->user())
                <div class="d-flex justify-content-center">
                    <a href="{{ route('customer.dashboard') }}"><button class="btn btn-outline-success">Retour à mon compte</button></a>
                </div>
            @endif
        </div>
    </div>
@endsection
