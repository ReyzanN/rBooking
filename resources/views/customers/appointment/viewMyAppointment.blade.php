@extends('layouts.app.customers.layouts')

@section('title','Rendez-vous du '.$Registration->ParseDateToString($Registration->GetAppointment()->date))

@section('content')
    <div class="container mt-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="#">Mes rendez-vous</a></li>
                <li class="breadcrumb-item">Rendez-vous du : {{ $Registration->ParseDateToString($Registration->GetAppointment()->date) }}</li>
            </ol>
        </nav>

        <div class="row">
            <h4 class="bg-body-tertiary rounded-3 mt-2 mb-2"><i class="bi bi-geo-alt"></i>&nbsp;Lieu du rendez-vous</h4>
            <div class="row">
                <div class="mt-1 mb-3">
                    <input type="hidden" name="mapCoords" id="mapCoords" value="{{ $Registration->GetAppointment()->GetAppointmentType()->jsonCoordinatesInformations }}">
                    <div class="row">
                        <div id="map" class="rounded-3"></div>
                    </div>
                </div>
                <small class="mb-2 opacity-75">Adresse : {{ $Registration->GetAppointment()->GetAppointmentType()->GetLocationFull() }}</small>
            </div>
            <h4 class="bg-body-tertiary rounded-3 mt-2 mb-2"><i class="bi bi-info-circle"></i>&nbsp;Information du rendez-vous</h4>
            <div class="d-flex justify-content-center align-items-center text-center">
                <ul class="list-group">
                    <li class="list-group-item">Date & Heure : {{ $Registration->ParseDateToString($Registration->GetAppointment()->date) }}</li>
                    <li class="list-group-item">Type lié : {{ $Registration->GetAppointment()->GetAppointmentType()->name }}</li>
                    <li class="list-group-item">Status :
                        @switch($Registration->status)
                            @case(1)
                                <span class="badge rounded-pill text-bg-warning">Confirmation en attente</span>
                                @break
                            @case(2)
                            <span class="badge rounded-pill text-bg-success">Confirmé</span>
                            @break
                            @case(3)
                            <span class="badge rounded-pill text-bg-danger">Annuler</span>
                            @break
                        @endswitch
                    </li>
                    <li class="list-group-item">Nombre de place : {{ $Registration->GetAppointment()->place }}</li>
                    <li class="list-group-item">Complet : @if($Registration->GetAppointment()->complete) <span class="badge rounded-pill text-bg-success">Oui</span> @else <span class="badge rounded-pill text-bg-danger">Non</span> @endif</li>
                </ul>
            </div>
            <h4 class="bg-body-tertiary rounded-3 mt-2 mb-2"><i class="bi bi-hand-index-thumb"></i>&nbsp;Vos Actions</h4>
            @if($Registration->status == 2)
                <div class="mt-1 mb-3">
                    <ul class="list-group mt-3 mb-5">
                        <li class="list-group-item d-flex justify-content-center align-items-center"><button class="btn btn-danger">Annuler mon rendez-vous</button> </li>
                    </ul>
                </div>
            @elseif($Registration->status == 1)
                <div class="mt-1 mb-5">
                    <div class="alert alert-warning" role="alert">
                        Pour annuler ce rendez-vous, servez vous du lien reçu par email.
                    </div>
                </div>
            @else
                <div class="mt-1 mb-5">
                    <div class="alert alert-light" role="alert">
                        Aucune action disponible
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('script')
@endsection
