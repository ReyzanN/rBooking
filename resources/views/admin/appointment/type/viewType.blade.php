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
                    <button class="btn btn-outline-success mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#AddAppointment"><i class="bi bi-bookmark-plus"></i>&nbsp;Ajouter un créneau de rendez-vous</button>
                    <button class="btn btn-outline-warning mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#updateType"><i class="bi bi-pencil-square"></i>&nbsp;Modifier le type</button>
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
                                    <p class="card-text"><i class="bi bi-calendar2-week"></i>&nbsp; Rendez-vous le : <b>{{ $Appointment->ParseDateForAppointment($Appointment->date) }}</b></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline-success"><i class="bi bi-person-add"></i></button>
                                        </div>
                                        <small class="text-body-secondary">Place disponibles : {{ $Appointment->GetRemainingPlace() }} / {{ $Appointment->place }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach($AppointmentType->GetNonAvailableAppointment() as $Appointment)
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-img-top d-flex justify-content-center align-items-center">
                                    <i class="bi bi-calendar-x" style="font-size: 2rem"></i>&nbsp;<span class="badge rounded-pill text-bg-danger">Non disponible</span>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><i class="bi bi-calendar2-week"></i>&nbsp; Rendez-vous le : <b>{{ $Appointment->ParseDateForAppointment($Appointment->date) }}</b></p>
                                    <p class="card-text"></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></button>
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

    <!-- Modal Update Type -->
    <div class="modal modal-lg fade" id="updateType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateTypeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateTypeLabel">Modification Type de rendez-vous</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.appointment.type.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $AppointmentType->id }}">
                        <div class="row mt-2 mb-2">
                            <p class="bg-body-tertiary"><i class="bi bi-tag"></i>&nbsp;Identification du Type</p>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Aide aux impots" value="{{ $AppointmentType->name }}">
                                    <label for="name">Nom du Type</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Description du type" id="description" name="description" style="height: 120px" maxlength="255">{{ $AppointmentType->description }}</textarea>
                                    <label for="description">Description du Type</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-2 d-flex justify-content-center align-items-center">
                            <hr class="w-75">
                        </div>
                        <div class="row mt-2 mb-2">
                            <p class="bg-body-tertiary"><i class="bi bi-geo-alt"></i>&nbsp;Localisation</p>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-3">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="streetNumber" name="streetNumber" placeholder="12" maxlength="50" value="{{ $AppointmentType->streetNumber }}">
                                    <label for="streetNumber">N° Rue</label>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Rue Des Lilas" maxlength="50" value="{{ $AppointmentType->street }}">
                                    <label for="street">Rue</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Yssingeaux" maxlength="50" value="{{ $AppointmentType->location }}">
                                    <label for="location">Ville</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="zipCode" name="zipCode" maxlength="50" value="{{ $AppointmentType->zipCode }}">
                                    <label for="zipCode">Code Postal</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <p class="bg-body-tertiary"><i class="bi bi-check-circle"></i>&nbsp;Activation</p>
                        </div>
                        <select class="form-select" aria-label="Status activation" name="active" id="active">
                            <option selected value="1">Actif</option>
                            <option value="0">Désactivé</option>
                        </select>
                        <div class="row mt-2 mb-2">
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-warning">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Appointment -->
    <div class="modal modal-lg fade" id="AddAppointment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddAppointmentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="AddAppointmentLabel">Ajouter un rendez-vous</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.appointment.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="idAppointmentType" id="idAppointmentType" value="{{ $AppointmentType->id }}">
                        <div class="row mt-2 mb-2">
                            <p class="bg-body-tertiary"><i class="bi bi-tag"></i>&nbsp;Identification</p>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="datetime-local" class="form-control" id="date" name="date" value="{{ request()->old('date') }}" required>
                                    <label for="date">Date & Heure</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="place" name="place" value="{{ request()->old('place') }}" required>
                                    <label for="place">Nombre de places</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-success">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
