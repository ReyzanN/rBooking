@extends('layouts.app.admin.layouts')

@section('title', 'Administration - Gestion utilisateurs')

@section('content')
    <div class="container mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item">Membres</li>
                <li class="breadcrumb-item active" aria-current="page">Voir Tout</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col">
                <h4 class="bg-body-tertiary"><i class="bi bi-people"></i>&nbsp;Voir tous les members</h4>
                <span class="badge text-bg-light">Total de {{ $UserCount }} membre(s) inscrits</span>
            </div>
        </div>
        <div class="row mt-5">
            <table class="table" id="MembersTable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Droit</th>
                    @if(auth()->user()->isAdmin())
                    <th scope="col">Gestion</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($Users as $U)
                    <tr>
                        <th scope="row">{{ $U->id }}</th>
                        <td>{{ $U->surname }}</td>
                        <td>{{ $U->name }}</td>
                        <td>{{ $U->GetRankString() }}</td>
                        @if(auth()->user()->isAdmin())
                        <td class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ViewUser"><i class="bi bi-eye"></i></button>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if(auth()->user()->isAdmin())
    <!-- Modal -->
    <div class="modal modal-lg fade" id="ViewUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ViewUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ViewUserLabel">Consultation d'utilisateur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('script')
    <script src="/js/ajaxCustom/Search.js"></script>
@endsection
