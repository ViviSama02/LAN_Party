@extends('layouts.app')

@section('content')
    <div class="bg-primary text-light" style="height: 200px;">
        <div class="container">
            <div class="row">
                <h1 class="title centre" style="margin-top: 50px;">Ajouter un Tournoi</h1>
            </div>
        </div>
    </div>
    <div class="container shadow-top">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-n5">
                    <div class="card-header">Créer un nouveau Tournoi pour la LAN <a href="{{ route('lan.show', $lan) }}">{{ $lan->nom }}</a></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('lan.tournament.store', $lan) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">Nom du Tournoi</label>

                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="name" autofocus>

                                    @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="api" class="col-md-4 col-form-label text-md-right">Clé d'API <a href="https://challonge.com/fr/settings/developer#">Challonge</a></label>

                                <div class="col-md-6">
                                    <input id="api" type="password" class="form-control @error('api') is-invalid @enderror" name="api" value="{{ old('api') }}" required>

                                    @error('api')
                                        @foreach($errors->get('api') as $message)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @endforeach
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">Type de Tournoi</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                                    @foreach($types as $type)
                                        @if(old('type') == $type)
                                            <option value="{{  $type['value'] }}" selected>{{ $type['name'] }}</option>
                                        @else
                                            <option value="{{  $type['value'] }}">{{ $type['name'] }}</option>
                                        @endif
                                    @endforeach
                                    </select>

                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="equipe" class="col-md-4 col-form-label text-md-right">Nombre de participants par équipe</label>
                                <div class="col-md-6">
                                    <input id="equipe"
                                           name="equipe"
                                           type="number"
                                           min="0"
                                           class="form-control @error('equipe') is-invalid @enderror"
                                           value="{{ old('equipe', 1) }}"
                                           required>

                                    @error('equipe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a type="button" class="btn btn-danger" href="{{ route('lan.show', $lan) }}">
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
