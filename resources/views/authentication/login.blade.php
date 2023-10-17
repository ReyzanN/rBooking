@extends('layouts.app.guest.layouts')

@section('title','Me connecter')

@section('content')
    <div class="container mt-3 d-flex justify-content-center align-items-center">
        <div class="card registerCard">
            <div class="d-flex justify-content-center align-items-center">
                <i class="bi bi-person-add" style="font-size: 5rem"></i>
                <h1>Se Connecter</h1>
            </div>
            <div class="card-body">
                @include('layouts.app.common.errors')
                <hr>
                <form action="{{ route('auth.login.confirm') }}" method="post">
                    @csrf

                    <div class="row mt-2">
                        <div class="col-6 mt-2">
                            <input type="email" name="email" class="form-control" id="email" placeholder="jean.martin@gmail.com" value="{{ request()->old('email') }}">
                        </div>
                        <div class="col-6 row mt-2">
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe" aria-describedby="eyes">
                                <span class="input-group-text" id="eyes" onclick="handleClick()"><i class="bi bi-eye"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <a href="{{ route('password.redeem') }}"><p class="text-center">J'ai oublié mon mot de passe</p></a>
                    </div>

                    <div class="row mt-2">
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-success" type="submit"><i class="bi bi-check2-all"></i>&nbsp;Me Connecter</button>
                        </div>
                    </div>
                </form>
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
