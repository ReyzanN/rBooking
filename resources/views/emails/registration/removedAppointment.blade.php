@extends('layouts.app.email.layout')

@section('content')
    <div class="container">
        <h5 class="robotoR400">Bonjour {{ $AppointmentRegistration->GetUser()->name }},</h5>
        <p>Nous sommes au regret de vous annoncer que votre rendez-vous ci-dessous est annulé. Pour plus d'information merci de nous contacter</p>
        <div class="row">
            <p class="bg-body-tertiary"><i class="bi bi-info-circle"></i>&nbsp;Informations pour votre rendez-vous</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Date & Heure : <br>{{ $AppointmentRegistration->ParseDateForAppointment($AppointmentRegistration->GetAppointment()->date) }}</li>
                <li class="list-group-item">Adresse : <br>{{ $LocationComplete }}</li>
            </ul>
        </div>
    </div>
@endsection
