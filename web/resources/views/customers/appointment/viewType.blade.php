@extends('layouts.app.customers.layouts')

@section('title', $AppointmentType->name)

@section('content')
    <div class="container mb-5">
        <div class="container mt-2">
            <div class="row mt-2">
                <div class="col d-flex flex-column">
                    <h4 class="bg-body-tertiary"><i class="bi bi-hash"></i>&nbsp;{{ $AppointmentType->name }}</h4>
                    <div class="mt-3 mb-3">
                        <a href="{{ route('customers.appointment.type.view') }}"><button class="btn btn-secondary"><i class="bi bi-arrow-return-left"></i>&nbsp;Retour</button></a>
                        <button class="btn btn-success" onclick="location.reload()"><i class="bi bi-arrow-clockwise"></i>&nbsp;Rafraichir</button>
                    </div>
                    <div>
                        @include('layouts.app.common.errors')
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="row mt-3">
                    <h5 class="bg-body-tertiary rounded-3 text-center"><i class="bi bi-calendar-check"></i>&nbsp;Liste des rendez-vous disponibles</h5>
                </div>
                <div class="col">
                    @if(count($Appointments) > 0)
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach($Appointments as $Appointment)
                            <div class="col mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-img-top d-flex justify-content-center align-items-center">
                                        <i class="bi bi-calendar-check" style="font-size: 2rem"></i>&nbsp;<span class="badge rounded-pill text-bg-success">Disponible</span>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><i class="bi bi-calendar2-week"></i>&nbsp;<b>{{ $Appointment->ParseDateForAppointment($Appointment->date) }}</b></p>
                                        <p class="mt-2 mb-2"><small class="text-body-secondary">Place disponibles : {{ $Appointment->GetRemainingPlace() }} / {{ $Appointment->place }}</small></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('customers.appointment.register', $Appointment->id) }}"><button class="btn btn-outline-primary"><i class="bi bi-hand-index-thumb"></i>&nbsp;Prendre rendez-vous</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @else
                        <div class="col d-flex justify-content-center mt-3">
                            <div class="alert alert-light" role="alert">
                                Aucun rendez-vous disponible
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="row mt-3">
                            <h5 class="bg-body-tertiary rounded-3 text-center"><i class="bi bi-info-circle"></i>&nbsp;Informations</h5>
                            <div class="mt-1 mb-3">
                                <input type="hidden" name="mapCoords" id="mapCoords" value="{{ $AppointmentType->jsonCoordinatesInformations }}">
                                <div class="row">
                                    <div id="map" class="rounded-3"></div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="alert alert-light" role="alert">
                                    {{ $AppointmentType->description }}
                                </div>
                                <div class="mt-2">
                                    <p><i class="bi bi-geo-alt"></i>&nbsp;Adresse : {{ $AppointmentType->streetNumber }} {{ $AppointmentType->street }} / {{ $AppointmentType->zipCode }} {{ $AppointmentType->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
