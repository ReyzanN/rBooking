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
                <h4 class="bg-body-tertiary"><i class="bi bi-calendar-day"></i>&nbsp;Rendez-vous du jour</h4>
            </div>
            <div class="col">
                <h4 class="bg-body-tertiary"><i class="bi bi-info-circle"></i>&nbsp;Informations de la journée</h4>
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
