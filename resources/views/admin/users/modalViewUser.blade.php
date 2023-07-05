<div class="row mt-3">
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="surname" readonly value="{{ $User->surname }}">
            <label for="surname">Nom</label>
        </div>
    </div>
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" readonly value="{{ $User->name }}">
            <label for="name">Prénom</label>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" readonly value="{{ $User->email }}">
            <label for="email">Email</label>
        </div>
    </div>
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="name" readonly value="{{ $User->phone }}">
            <label for="name">Téléphone</label>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="rank" readonly value="{{ $User->GetRankString() }}">
            <label for="rank">Rang</label>
        </div>
    </div>
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="accountValidity" readonly value="{{ $User->GetValidityString() }}">
            <label for="accountValidity">Validité du compte</label>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="datetime-local" class="form-control" id="created_at" readonly value="{{ $User->created_at }}">
            <label for="created_at">Date de création du compte</label>
        </div>
    </div>
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="datetime-local" class="form-control" id="updated_at" readonly value="{{ $User->updated_at }}">
            <label for="updated_at">Date de modification du compte</label>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="datetime-local" class="form-control" id="lastConnection" readonly value="{{ $User->lastConnection }}">
            <label for="lastConnection">Dernière connexion</label>
        </div>
    </div>
    <div class="col-6 d-flex justify-content-around align-items-center">
        <button class="btn btn-outline-danger"><i class="bi bi-person-lock"></i></button>
        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#UpdateRight" data-bs-user="{{ $User->id }}" data-bs-right="{{ $User->GetRankString() }}"><i class="bi bi-person-gear"></i></button>
        <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
    </div>
</div>
