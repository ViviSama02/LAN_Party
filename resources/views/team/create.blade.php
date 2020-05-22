@extends('layouts.app')
@php
    if(isset($team)) {
        $edit = true;
    } else {
        $edit = false;
    }
@endphp

@section('content')
    <div class="bg-primary text-light" style="height: 200px;">
        <div class="container">
            <div class="row">
                <h1 class="title centre" style="margin-top: 50px;">
                    Mon équipe
                </h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-n5">
                    <div class="card-header">
                        @if($edit)
                            Modifier l'équipe
                        @else
                            Créer une équipe
                        @endif
                        pour le tournoi <a href="{{ route('tournament.show', $tournament) }}">{{ $tournament->nom }}</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ $edit ? route('team.update', $team) : route('team.store') }}">
                            @csrf
                            @method($edit ? 'PUT' : 'POST')

                            @unless($edit)
                                <input type="hidden" name="tournament" value="{{ $tournament->id }}">
                            @endunless

                            <div class="form-group row">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">Nom de l'équipe</label>

                                <div class="col-md-6">
                                    <input id="nom"
                                           type="text"
                                           class="form-control @error('nom') is-invalid @enderror"
                                           name="nom"
                                           value="{{ old('nom', $edit ? $team->nom : "") }}"
                                           required
                                           autofocus>

                                    @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <a type="submit" class="btn btn-warning float-left" href="{{ route('tournament.show', $tournament) }}">
                                        Retour
                                    </a>
                                </div>
                                <div class="col-md-6">

                                    <button type="submit" class="btn btn-success float-right">
                                        Accepter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
