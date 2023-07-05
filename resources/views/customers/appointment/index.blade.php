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
                <button class="btn btn-success"><i class="bi bi-arrow-clockwise"></i>&nbsp;Rafraichir</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
