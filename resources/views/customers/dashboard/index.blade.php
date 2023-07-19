@extends('layouts.app.customers.layouts')

@section('title', 'Tableau de bord')

@section('content')
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Tableau de bord</a></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <h4><i class="bi bi-calendar"></i>&nbsp;Rendez-vous de la journée</h4>
                <span class="badge rounded-pill text-bg-light"><i class="bi bi-clock"></i>&nbsp; {{ $Time }}</span>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-2">
                    @if(count($AppointmentOfDay) > 0)
                        @foreach($AppointmentOfDay as $Registration)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <div class="card-img-top d-flex justify-content-center align-items-center">
                                        <i class="bi bi-info" style="font-size: 2rem"></i>&nbsp;{{ $Registration->GetAppointment()->GetAppointmentType()->name }}
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
                    @else
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="alert alert-light text-center" role="alert">
                                Aucun rendez-vous
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col">
                <h4><i class="bi bi-calendar-check"></i>&nbsp;Rendez-vous en attente de confirmation</h4>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-2">
                    @if(count($AppointmentConfirmationPending) > 0)
                        @foreach($AppointmentConfirmationPending as $Registration)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <div class="card-img-top d-flex justify-content-center align-items-center">
                                        <i class="bi bi-info" style="font-size: 2rem"></i>&nbsp;{{ $Registration->GetAppointment()->GetAppointmentType()->name }}
                                    </div>
                                    <div class="card-body">
                                        <p class="text-center"><i class="bi bi-clock"></i>&nbsp;{{ $Registration->ParseDateToString($Registration->GetAppointment()->date) }}</p>
                                        <div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
                                            <a href="{{ route('customers.appointment.my.view', $Registration) }}"><button class="btn btn-outline-primary"><i class="bi bi-eye"></i>&nbsp;Voir</button></a>
                                        </div>
                                        <small class="text-body-secondary">Rendez-vous pris le {{ $Registration->ParseDateToString($Registration->created_at) }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="alert alert-light text-center" role="alert">
                                Aucun rendez-vous en attente de confirmation
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection


@section('script')
@endsection
