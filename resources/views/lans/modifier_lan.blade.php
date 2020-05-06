@extends('layouts.app')

@section('content')
<div class="bg-primary text-light" style="height: 200px;">
    <div class="container">
        <div class="row">
            <h1 class="title centre" style="margin-top: 50px;">
                Modifier la LAN
            </h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card mt-n4 shadow">
                <div class="card-body">

                    <form method="POST" action="{{ route('lan.update', $lan) }}">
                        @method("PUT")
                        @csrf

                        <div class="form-group">
                            <label for="nom">Nom de la LAN</label>
                            <input type="text"
                                   class="form-control @error('nom') is-invalid @enderror"
                                   id="nom"
                                   name="nom"
                                   placeholder="Ma Super LAN perso"
                                   value="{{ old('nom', $lan->nom) }}" autofocus>

                            @error('nom')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Date de la LAN</label>
                            <input type="datetime-local"
                                   class="form-control @error('date') is-invalid @enderror"
                                   id="date" name="date"
                                   step="{{ 60*15 }}"
                                   value="{{ old('date', \Carbon\Carbon::parse($lan->date)->format('Y-m-d\TH:i')) }}">

                            @error('date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max">Maximum de participants</label>
                            <input type="number"
                                   id="max"
                                   name="max"
                                   class="form-control @error('max') is-invalid @enderror"
                                   min="0"
                                   max="9999999"
                                   step="1"
                                   placeholder="32"
                                   value="{{ old('max', $lan->max) }}">

                            @error('max')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="info">Description de la LAN</label>
                            <textarea class="form-control @error('info') is-invalid @enderror"
                                      id="info"
                                      name="info"
                                      rows="10"
                                      placeholder="Voici pleins d'informations super utiles sur la LAN.">{{ old('info', $lan->info) }}</textarea>

                            @error('info')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <a class="btn btn-danger" href="{{ route('lan.show', $lan) }}">Annuler</a>
                        <input type="submit" class="btn btn-success float-right">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection