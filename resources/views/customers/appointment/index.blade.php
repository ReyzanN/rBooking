@extends('layouts.app.customers.layouts')

@section('title','Prise de rendez-vous')

@section('content')
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item">Prendre rendez-vous</li>
                <li class="breadcrumb-item active" aria-current="page">Type de rendez-vous</li>
            </ol>
        </nav>
        <div class="row mt-2 d-flex flex-column">
            <h4 class="bg-body-tertiary"><i class="bi bi-hash"></i>&nbsp;Type de rendez-vous disponible</h4>
            <div class="mt-3 mb-3">
                <button class="btn btn-success" onclick="location.reload()"><i class="bi bi-arrow-clockwise"></i>&nbsp;Rafraichir</button>
            </div>
            <div class="row">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($AppointmentType as $Type)
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-img-top d-flex justify-content-center align-items-center">
                                    <i class="bi bi-calendar" style="font-size: 2rem"></i>&nbsp;{{ $Type->name }}
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-light" role="alert">
                                        <i class="bi bi-info-circle"></i>&nbsp;{{ $Type->description }}
                                    </div>
                                    <div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
                                        <a href="{{ route('customers.appointment.type.view.target', $Type->id) }}"><button class="btn btn-outline-primary"><i class="bi bi-hand-index-thumb"></i>&nbsp;Prendre rendez-vous</button></a>
                                    </div>
                                    <small class="text-body-secondary">Rendez-vous disponibles : {{ count($Type->GetActiveAppointmentForBooking()) }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
