@extends('layouts.app.admin.layouts')

@section('title','Administration - Tableau de board')

@section('content')
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Tableau De Bord</li>
            </ol>
        </nav>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col">
                <h4 class="bg-body-tertiary rounded-2"><i class="bi bi-calendar-day"></i>&nbsp;Rendez-vous du jour</h4>
                    @foreach($AppointmentType as $AT)
                        <div class="row mt-3">
                            <div class="accordion" id="AppointmentList">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{$AT->name}}-{{$AT->name}}" aria-expanded="true" aria-controls="{{$AT->name}}-{{$AT->name}}">
                                                {{ $AT->name }}
                                        </button>
                                    </h2>
                                    <div id="{{$AT->name}}-{{$AT->name}}" class="accordion-collapse collapse" data-bs-parent="#AppointmentList">
                                        <div class="accordion-body">
                                            <div class="mt-3">
                                                <p class="bg-body-tertiary rounded-2"><i class="bi bi-calendar-day"></i>&nbsp;Rendez-vous complet</p>
                                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                                    @foreach($AT->AppointmentListComplete as $Appointment)
                                                        <div class="col">
                                                            <div class="card shadow-sm">
                                                                <div class="card-img-top d-flex justify-content-center align-items-center">
                                                                    <i class="bi bi-calendar-check" style="font-size: 2rem"></i>&nbsp;<span class="badge rounded-pill text-bg-success">Complet</span>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text"><i class="bi bi-calendar2-week"></i>&nbsp;<b>{{ $Appointment->ParseDateForAppointment($Appointment->date) }}</b></p>
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('admin.appointment.view', $Appointment->id) }}"><button type="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button></a>
                                                                            <a href="{{ route('admin.appointment.archive', $Appointment->id) }}"><button type="button" class="btn btn-sm btn-outline-secondary"><i class="bi bi-archive"></i></button></a>
                                                                        </div>
                                                                        <small class="text-body-secondary">Place disponibles : {{ $Appointment->GetRemainingPlace() }} / {{ $Appointment->place }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <p class="bg-body-tertiary rounded-2"><i class="bi bi-calendar-day"></i>&nbsp;Rendez-vous non complet</p>
                                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                                    @foreach($AT->AppointmentListInComplete as $Appointment)
                                                        <div class="col">
                                                            <div class="card shadow-sm">
                                                                <div class="card-img-top d-flex justify-content-center align-items-center">
                                                                    <i class="bi bi-calendar-check" style="font-size: 2rem"></i>&nbsp;<span class="badge rounded-pill text-bg-warning">Non Complet</span>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text"><i class="bi bi-calendar2-week"></i>&nbsp; <b>{{ $Appointment->ParseDateForAppointment($Appointment->date) }}</b></p>
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('admin.appointment.view', $Appointment->id) }}"><button type="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button></a>
                                                                            <a href="{{ route('admin.appointment.archive', $Appointment->id) }}"><button type="button" class="btn btn-sm btn-outline-secondary"><i class="bi bi-archive"></i></button></a>
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
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col">
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
