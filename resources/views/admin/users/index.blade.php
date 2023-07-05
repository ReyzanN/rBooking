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
                    <th scope="col">Droit</th>
                    @if(auth()->user()->IsAdmin())
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
                        @if(auth()->user()->IsAdmin())
                        <td class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ViewUser" onclick="SearchAjax({{ $U->id }},'{{ route('admin.members.view.ajax') }}','ModalBodyUser','{{ csrf_token() }}')"><i class="bi bi-eye"></i></button>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if(auth()->user()->IsAdmin())
    <!-- Modal -->
    <div class="modal modal-lg fade" id="ViewUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ViewUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ViewUserLabel">Consultation d'utilisateur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="ModalBodyUser">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->IsSuperAdmin())
        <div class="modal fade" id="UpdateRight" tabindex="-1" aria-labelledby="UpdateRightLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modification des droits de l'utilisateur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            <input type="hidden" name="user" id="userInputRight" value="">
                            <div class="mt-3 mb-3">
                                <div class="alert alert-primary" role="alert">
                                    Ancien rang : <span class="badge text-bg-light" id="RankSpan"></span>
                                </div>
                            </div>
                            <div class="mt-3 mt-3">
                                <hr>
                            </div>
                            <div class="mt-3 mb-3">
                                <form action="" method="post">
                                    @csrf
                                    <select class="form-select" aria-label="Selection du Rang">
                                        <option selected>Selection du nouveau Rang</option>
                                        <option value="0">Client</option>
                                        <option value="1">Consultant</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Super-Admin</option>
                                    </select>
                                    <div class="mb-3 mt-3 d-flex justify-content-around align-items-center">
                                        <button class="btn btn-success">Valider</button>
                                    </div>
                                </form>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#ViewUser">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endif

@endsection

@section('script')
    <script src="/js/ajaxCustom/Search.js"></script>
    <script>
        const ModalRight = document.getElementById('UpdateRight')
        if (ModalRight) {
            ModalRight.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const User = button.getAttribute('data-bs-user')
                const Right = button.getAttribute('data-bs-right')
                const modalUserInput = ModalRight.querySelector('#userInputRight')
                const modalRankSpan = ModalRight.querySelector('#RankSpan')
                modalUserInput.value = User
                modalRankSpan.innerHTML = Right
            })
        }
    </script>
@endsection
