@extends('layouts.app.admin.layouts')

@section('title',$AppointmentType->name)


@section('content')
    <div class="container mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item">Rendez-vous</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.appointment.type.view') }}">Type</a></li>
                <li class="breadcrumb-item active" aria-current="page">#{{$AppointmentType->id}} {{ $AppointmentType->name }}</li>
            </ol>
        </nav>
        <div class="row mt-2">
            <div class="col d-flex flex-column">
                <h4 class="bg-body-tertiary"><i class="bi bi-hash"></i>&nbsp;Type de rendez-vous : {{ $AppointmentType->name }}</h4>
                <div><span class="badge text-bg-light">Total de rendez-vous : 12</span></div>
                <div class="mt-2">
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#AddTypeModal"><i class="bi bi-bookmark-plus"></i>&nbsp;Ajouter un créneau de rendez-vous</button>
                    <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#AddTypeModal"><i class="bi bi-pencil-square"></i>&nbsp;Modifier le type</button>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <hr class="w-75">
                </div>
                <div>
                    @include('layouts.app.common.errors')
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <input type="hidden" name="mapCoords" id="mapCoords" value="{{ $AppointmentType->jsonCoordinatesInformations }}">
                <div class="row">
                    <div id="map" class="rounded-3"></div>
                </div>
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
            <div class="col">
                CARD
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
