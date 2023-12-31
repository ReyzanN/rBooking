@extends('layouts.app.guest.layouts')

@section('title','Création de compte')

@section('content')
    <div class="container mt-3 d-flex justify-content-center align-items-center flex-column">
        <div class="card RegisterCard">
            <div class="d-flex justify-content-center align-items-center">
                <i class="bi bi-person-add" style="font-size: 5rem"></i>
                <h1>Création de Compte</h1>
            </div>
            <div class="card-body">
                @include('layouts.app.common.errors')
                <hr>
                <form action="{{ route('auth.register.confirm') }}" method="post">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="surname" class="form-control" id="surname" placeholder="Martin" value="{{ request()->old('surname') }}">
                                <label for="surname">Nom</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Jean" value="{{ request()->old('name') }}">
                                <label for="name">Prénom</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="jean.martin@gmail.com" value="{{ request()->old('email') }}">
                                <label for="email">Adresse Email</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="tel" name="phone" class="form-control" id="phone" placeholder="0769XXXXXX" maxlength="10" value="{{ request()->old('phone') }}">
                                <label for="phone">Téléphone</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe" aria-describedby="eyes">
                                <span class="input-group-text" id="eyes" onclick="handleClick()"><i class="bi bi-eye"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="progress d-none" role="progressbar" aria-label="Success example" aria-valuenow="0" aria-valuemin="12" aria-valuemax="120" id="ProgressPassword">
                        <div class="progress-bar bg-success" style="width: 0" id="ProgressBarChild"></div>
                    </div>

                    <div class="row mt-2">
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-success" type="submit"><i class="bi bi-check2-all"></i>&nbsp;Créer Mon Compte</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('auth.login') }}">J'ai déjà un compte</a>
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

        const ProgressBar = document.getElementById('ProgressPassword');
        const ProgressBarChild = document.getElementById('ProgressBarChild');
        field.addEventListener('focus', function(){
            ProgressBar.classList.remove('d-none');
        })
        field.addEventListener('blur', function(){
            ProgressBar.classList.add('d-none');
        })
        let Count = 0
        field.addEventListener('keyup', function(){
            ProgressBar.setAttribute('aria-valuenow', field.value.length)
            ProgressBarChild.style.width = field.value.length*8.5+'%'
        })
    </script>
@endsection
