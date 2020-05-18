@extends('global_template')

@section('contenu')
<div class="bg-primary text-light" style="height: 200px;">
    <div class="container">
        <div class="row">
            <h1 class="title centre" style="margin-top: 50px;">Rejoignez nos LANs</h1>
        </div>
    </div>
</div>
<div class="shadow-top">
    <div class="container" style="padding:20px 0">
        <div class="card centre shadow" style="max-width: 450px;margin-top: -67px;">
            <div class="card-header">Formulaire d'inscription</div>
            <div class="card-body">
              {{-- <form action="#">
                  <div class="form-group">
                    <label for="emailField">Adresse email</label>
                    <input type="email" class="form-control" id="emailField" placeholder="exemple@exemple.fr">
                  </div>
                  <div class="form-group">
                    <label for="passwordField">Mot de passe</label>
                    <input type="password" class="form-control" id="passwordField">
                  </div>
                  <div class="form-group">
                    <label for="confirmPasswordField">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="confirmPasswordField">
                  </div>
                  <br>
                  <button type="button" class="btn btn-danger">Annuler</button>
                  <button type="submit" class="btn btn-success" style="float: right;">Valider</button>
              </form> --}}
              <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nom</label>

                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Adresse Email</label>

                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>

                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirmer le mot de passe</label>

                    <div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg btn-block" style="margin-top:30px">
                    Valider
                </button>
            </form>
            </div>
          </div>
    </div>
</div>
@endsection
