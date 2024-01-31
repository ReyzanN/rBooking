@extends('layouts.app.customers.layouts')

@section('title', 'Mes rendez-vous')

@section('content')
    <div class="container mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customers.appointment.history') }}">Mes rendez-vous</a></li>
            </ol>
        </nav>

        <div class="row">
            <h4 class="bg-body-tertiary rounded-3"><i class="bi bi-clock-history"></i>&nbsp;Historique de rendez-vous</h4>
            <div class="row mt-2">
                <div class="accordion" id="HistoryAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Tous mes rendez-vous
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#HistoryAccordion">
                            <div class="accordion-body">
                                @if(count($AllRegistration) > 0)
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                        @foreach($AllRegistration as $Registration)
                                            <div class="col">
                                                <div class="card shadow-sm">
                                                    <div class="card-img-top d-flex justify-content-center align-items-center">
                                                        @switch($Registration->status)
                                                            @case(1)
                                                                <p><i class="bi bi-info" style="font-size: 2rem"></i>&nbsp;{{ $Registration->GetAppointment()->GetAppointmentType()->name }} - <span class="badge rounded-pill text-bg-warning">En attente</span></p>
                                                                @break
                                                            @case(2)
                                                                <p><i class="bi bi-info" style="font-size: 2rem"></i>&nbsp;{{ $Registration->GetAppointment()->GetAppointmentType()->name }} - <span class="badge rounded-pill text-bg-success">Actif</span></p>
                                                                @break
                                                            @case(3)
                                                                <p><i class="bi bi-info" style="font-size: 2rem"></i>&nbsp;{{ $Registration->GetAppointment()->GetAppointmentType()->name }} - <span class="badge rounded-pill text-bg-danger">Annulé</span></p>
                                                                @break
                                                        @endswitch
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="text-center"><i class="bi bi-clock"></i>&nbsp;{{ $Registration->ParseDateToString($Registration->GetAppointment()->date) }}</p>
                                                        <div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
                                                            <a href="{{ route('customers.appointment.my.view', $Registration) }}"><button class="btn btn-outline-primary"><i class="bi bi-eye"></i>&nbsp;Voir</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col d-flex justify-content-center mt-3">
                                        <div class="alert alert-light" role="alert">
                                            Aucun Historique
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Rendez-vous du jour
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#HistoryAccordion">
                            <div class="accordion-body">
                                @if(count($RegistrationOfDay) > 0)
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                        @foreach($RegistrationOfDay as $Registration)
                                            <div class="col">
                                                <div class="card shadow-sm">
                                                    <div class="card-img-top d-flex justify-content-center align-items-center">
                                                        <p><i class="bi bi-info" style="font-size: 2rem"></i>&nbsp;{{ $Registration->GetAppointment()->GetAppointmentType()->name }} - <span class="badge rounded-pill text-bg-success">Actif</span></p>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="text-center"><i class="bi bi-clock"></i>&nbsp;{{ $Registration->ParseDateToString($Registration->GetAppointment()->date) }}</p>
                                                        <div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
                                                            <a href="{{ route('customers.appointment.my.view', $Registration) }}"><button class="btn btn-outline-primary"><i class="bi bi-eye"></i>&nbsp;Voir</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col d-flex justify-content-center mt-3">
                                        <div class="alert alert-light" role="alert">
                                            Aucun Historique
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Rendez-vous en attente de confirmation
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#HistoryAccordion">
                            <div class="accordion-body">
                                @if(count($PendingRegistration) > 0)
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                        @foreach($PendingRegistration as $Registration)
                                            <div class="col">
                                                <div class="card shadow-sm">
                                                    <div class="card-img-top d-flex justify-content-center align-items-center">
                                                        <p><i class="bi bi-info" style="font-size: 2rem"></i>&nbsp;{{ $Registration->GetAppointment()->GetAppointmentType()->name }} - <span class="badge rounded-pill text-bg-warning">En attente</span></p>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="text-center"><i class="bi bi-clock"></i>&nbsp;{{ $Registration->ParseDateToString($Registration->GetAppointment()->date) }}</p>
                                                        <div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
                                                            <a href="{{ route('customers.appointment.my.view', $Registration) }}"><button class="btn btn-outline-primary"><i class="bi bi-eye"></i>&nbsp;Voir</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col d-flex justify-content-center mt-3">
                                        <div class="alert alert-light" role="alert">
                                            Aucun Historique
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Rendez-vous annulés
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#HistoryAccordion">
                            <div class="accordion-body">
                                @if(count($CanceledRegistration) > 0)
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                        @foreach($CanceledRegistration as $Registration)
                                            <div class="col">
                                                <div class="card shadow-sm">
                                                    <div class="card-img-top d-flex justify-content-center align-items-center">
                                                        <p><i class="bi bi-info" style="font-size: 2rem"></i>&nbsp;{{ $Registration->GetAppointment()->GetAppointmentType()->name }} - <span class="badge rounded-pill text-bg-danger">Annulé</span></p>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="text-center"><i class="bi bi-clock"></i>&nbsp;{{ $Registration->ParseDateToString($Registration->GetAppointment()->date) }}</p>
                                                        <div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
                                                            <a href="{{ route('customers.appointment.my.view', $Registration) }}"><button class="btn btn-outline-primary"><i class="bi bi-eye"></i>&nbsp;Voir</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col d-flex justify-content-center mt-3">
                                        <div class="alert alert-light" role="alert">
                                            Aucun Historique
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
@endsection
