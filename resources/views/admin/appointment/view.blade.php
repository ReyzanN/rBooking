@extends('layouts.app.admin.layouts')

@section('title', 'Rendez-vous pour : '.$Appointment->GetAppointmentType()->name)

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item">Rendez-vous</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.appointment.type.view.target', $Appointment->GetAppointmentType()->id) }}">{{ $Appointment->GetAppointmentType()->name }}</a></li>
            </ol>
        </nav>

        <div>
            @include('layouts.app.common.errors')
        </div>

        <div class="row mt-4">
            <h4 class="bg-body-tertiary rounded-2"><i class="bi bi-info-circle"></i>&nbsp;Information</h4>
            <div class="d-flex">
                <ul class="list-group">
                    <li class="list-group-item">Date & Heure : {{ $Appointment->ParseDateToString($Appointment->date) }}</li>
                    <li class="list-group-item">Type de rendez-vous : {{ $Appointment->GetAppointmentType()->name }}</li>
                    <li class="list-group-item">Adresse : {{ $Appointment->GetAppointmentType()->GetLocationFull() }}</li>
                    <li class="list-group-item">Nombre de place : {{ $Appointment->place }}</li>
                    <li class="list-group-item">Nombre d'inscrit : {{ $Appointment->GetCountOfRegistration() }}</li>
                </ul>
            </div>
            <div class="mt-2 mb-2">
                <a href="{{ route('admin.appointment.archive', $Appointment->id) }}"><button class="btn btn-warning"><i class="bi bi-archive"></i>&nbsp;Archiver</button></a>
            </div>
        </div>

        <div class="row mt-4">
            <h4 class="bg-body-tertiary rounded-2"><i class="bi bi-info-circle"></i>&nbsp;Liste inscription</h4>
            <table class="table" id="TableAppointmentView">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($Appointment->GetAppointmentRegistration() as $Registration)
                    <tr>
                        <th scope="row">{{ $Registration->GetUser()->surname }}</th>
                        <th scope="row">{{ $Registration->GetUser()->name }}</th>
                        <th scope="row"><a href="tel:{{ $Registration->GetUser()->phone }}">{{ $Registration->GetUser()->phone }}</a></th>
                        <td>
                            @if($Registration->active)
                            <a href="{{ route('admin.appointment.registration.update', [$Registration->id,1]) }}"><button class="btn btn-success"><i class="bi bi-check2-all"></i></button></a>
                            <a href="{{ route('admin.appointment.registration.update', [$Registration->id,0]) }}"><button class="btn btn-danger"><i class="bi bi-x-circle"></i></button></a>
                            @elseif($Registration->present)
                                <span class="badge rounded-pill text-bg-success">Présent</span>
                            @else
                                <span class="badge rounded-pill text-bg-danger">Non présent</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
