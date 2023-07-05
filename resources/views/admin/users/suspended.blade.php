@extends('layouts.app.admin.layouts')

@section('title','Compte bloqué')

@section('content')
    <div class="container mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item">Membres</li>
                <li class="breadcrumb-item active" aria-current="page">Membre bloqué</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col">
                <h4 class="bg-body-tertiary"><i class="bi bi-people"></i>&nbsp;Voir tous les members bloqué</h4>
                <span class="badge text-bg-light">Total de {{ $Count }} membre(s) bloqué</span>
            </div>
        </div>
        <div class="row mt-1 mb-1">
            @include('layouts.app.common.errors')
        </div>
        <div class="row mt-5">
            <table class="table" id="MembersTable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Users as $U)
                    <tr>
                        <th scope="row">{{ $U->id }}</th>
                        <td>{{ $U->surname }}</td>
                        <td>{{ $U->name }}</td>
                        <td>{{ $U->email }}</td>
                        <td>{{ $U->phone }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
