@extends('layouts.app.guest.layouts')

@section('title','Choix nouveau mot de passe')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            @include('layouts.app.common.errors')
        </div>
        <div class="text-center d-flex justify-content-center">
            <div class="card" style="width: 30rem;">
                <i class="bi bi-pass" style="font-size: 7rem"></i>
                <div class="card-body">
                    <h5 class="card-title">Enregistrement d'un nouveau mot de passe</h5>
                    <p class="card-text">Merci de renseigner votre nouveau mot de passe.</p>
                    <form action="{{ route('password.setnewConfirm') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <div class="mb-3 text-center">
                                <input type="hidden" class="form-control text-center" id="_tokenPass" name="_tokenPass" value="{{ $token->token }}" readonly>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe" aria-describedby="eyes">
                                        <span class="input-group-text" id="eyes" onclick="handleClick()"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const field = document.getElementById('password')
        const icon = document.getElementById('eyes')
        function handleClick(){
            if (field.type === "password"){
                field.type = "text"
                icon.innerHTML = "<i class='bi bi-eye-slash'></i>"
            }else{
                field.type = "password"
                icon.innerHTML = "<i class='bi bi-eye'></i>"
            }
        }
    </script>
@endsection
