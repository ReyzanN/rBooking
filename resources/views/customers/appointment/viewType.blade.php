@extends('layouts.app.customers.layouts')

@section('title', $AppointmentType->name)

@section('content')
    <div class="container">
        <div class="container mt-2">
            <div class="row mt-2">
                <div class="col d-flex flex-column">
                    <h4 class="bg-body-tertiary"><i class="bi bi-hash"></i>&nbsp;{{ $AppointmentType->name }}</h4>
                    <div class="mt-3 mb-3">
                        <button class="btn btn-success" onclick="location.reload()"><i class="bi bi-arrow-clockwise"></i>&nbsp;Rafraichir</button>
                    </div>
                    <div>
                        @include('layouts.app.common.errors')
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <div class="row mt-3">
                        <h5 class="bg-body-tertiary rounded-3 text-center"><i class="bi bi-info-circle"></i>&nbsp;Informations</h5>
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
            <div class="row mt-2">
                <div class="row mt-3">
                    <h5 class="bg-body-tertiary rounded-3 text-center"><i class="bi bi-calendar-check"></i>&nbsp;Liste des rendez-vous disponibles</h5>
                </div>
                <div class="col">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach($AppointmentType->GetAvailableAppointment() as $Appointment)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <div class="card-img-top d-flex justify-content-center align-items-center">
                                        <i class="bi bi-calendar-check" style="font-size: 2rem"></i>&nbsp;<span class="badge rounded-pill text-bg-success">Disponible</span>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><i class="bi bi-calendar2-week"></i>&nbsp;<b>{{ $Appointment->ParseDateForAppointment($Appointment->date) }}</b></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('customers.appointment.register', $Appointment->id) }}"><button class="btn btn-outline-primary"><i class="bi bi-hand-index-thumb"></i>&nbsp;Prendre rendez-vous</button></a>
                                            </div>
                                            <small class="text-body-secondary">Place disponibles : {{ $Appointment->GetRemainingPlace() }} / {{ $Appointment->place }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
