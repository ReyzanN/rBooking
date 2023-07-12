@extends('layouts.app.email.layout')

@section('content')
    <div class="container">
        <h5 class="robotoR400">Bonjour {{ $AppointmentRegistration->GetUser()->name }},</h5>
        <p>Pour confirmer l'inscription à votre rendez-vous cliquez sur le bouton ci-dessous.</p>
        <div class="row">
            <p class="bg-body-tertiary"><i class="bi bi-info-circle"></i>&nbsp;Informations pour votre rendez-vous</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Date & Heure : <br>{{ $AppointmentRegistration->ParseDateForAppointment($AppointmentRegistration->GetAppointment()->date) }}</li>
                <li class="list-group-item">Adresse : <br>{{ $LocationComplete }}</li>
            </ul>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('appointment.customers.confirm', $AppointmentRegistration->confirmToken) }}"><button class="btn btn-success"><i class="bi bi-check-circle"></i>&nbsp;Confirmer</button></a>
            </div>
            <div class="col">
                <a href="{{ route('appointment.customers.unconfirm', $AppointmentRegistration->confirmToken) }}"><button class="btn btn-outline-danger"><i class="bi bi-check-circle"></i>&nbsp;Annuler</button></a>
            </div>
        </div>
    </div>
@endsection
