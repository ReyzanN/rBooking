@extends('layouts.app.admin.layouts')

@section('title','Gestion Type de Rendez-vous')

@section('content')
    <div class="container mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item">Rendez-vous</li>
                <li class="breadcrumb-item active" aria-current="page">Gestion des Types</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col d-flex flex-column">
                <h4 class="bg-body-tertiary"><i class="bi bi-hash"></i>&nbsp;Type de rendez-vous</h4>
                <div><span class="badge text-bg-light">Total de {{ $AppointmentTypeCount }} type(s)</span></div>
                <div><span class="badge text-bg-light">Total de {{ $AppointmentTypeCountActive }} type(s) actif(s)</span></div>
                <div class="mt-2">
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#AddTypeModal"><i class="bi bi-bookmark-plus"></i>&nbsp;Ajouter un Type</button>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <hr class="w-75">
                </div>
                <div>
                    @include('layouts.app.common.errors')
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-3 col">
            @foreach($AppointmentType as $AT)
                <div class="card text-center mt-2 mb-2">
                    <div class="card-header">
                        #{{ $AT->id }} - {{ $AT->GetStatusString() }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $AT->name }}</h5>
                        <p class="card-text">{{ $AT->description }}</p>
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <a href="{{ route('admin.appointment.type.view.target', $AT->id) }}"><button class="btn btn-outline-primary mt-2 mb-2"><i class="bi bi-cursor"></i>&nbsp;Selectioner ce type</button></a>
                            <a href="{{ route('admin.appointment.type.delete', $AT->id) }}"><button class="btn btn-outline-danger mt-2 mb-2"><i class="bi bi-trash"></i>&nbsp;Supprimer ce type</button></a>
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary">
                        {{ $AT->ParseDateToString($AT->created_at) }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="AddTypeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="AddTypeModalLabel"><i class="bi bi-bookmark-plus"></i>&nbsp;Ajouter un type de rendez-vous</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.appointment.type.add') }}" method="post">
                        @csrf
                        <div class="row mt-2 mb-2">
                            <p class="bg-body-tertiary"><i class="bi bi-tag"></i>&nbsp;Identification du Type</p>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Aide aux impots" value="{{ request()->old('name') }}">
                                    <label for="name">Nom du Type</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Description du type" id="description" name="description" style="height: 120px" maxlength="255">{{ request()->old('description') }}</textarea>
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
                                    <input type="number" class="form-control" id="streetNumber" name="streetNumber" placeholder="12" maxlength="50" value="{{ request()->old('streetNumber') }}">
                                    <label for="streetNumber">N° Rue</label>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Rue Des Lilas" maxlength="50" value="{{ request()->old('street') }}">
                                    <label for="street">Rue</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Yssingeaux" maxlength="50" value="{{ request()->old('location') }}">
                                    <label for="location">Ville</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="zipCode" name="zipCode" maxlength="50" value="{{ request()->old('zipCode') }}">
                                    <label for="zipCode">Code Postal</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-success">Valider</button>
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
