@extends('layouts.app')

@section('content')
    <div class="bg-primary text-light" style="height: 200px;">
        <div class="container">
            <div class="row">
                <h1 class="title centre" style="margin-top: 50px;">Modifier un Tournoi</h1>
            </div>
        </div>
    </div>
    <div class="container shadow-top">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-n5">
                    <div class="card-header">Modifier un Tournoi pour la LAN <a href="{{ route('lan.show', ['lan' => $lan]) }}">{{ $lan->nom }}</a></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tournament.update', $tournament) }}">
                            @method("PATCH")
                            @csrf

                            <div class="form-group row">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">Nom du Tournoi</label>

                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $tournament->nom) }}" required autocomplete="name" autofocus>

                                    @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a type="button" class="btn btn-danger" href="{{ route('tournament.show', compact('lan', 'tournament')) }}">
                                        {{ __('Cancel') }}
                                    </a>
                                    <input type="submit" class="btn btn-success float-right">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
