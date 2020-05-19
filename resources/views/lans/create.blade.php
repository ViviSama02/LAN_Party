@extends('layouts.form')
@php
    if(isset($lan)) {
        $edit = true;
    } else {
        $edit = false;
    }
@endphp

@section('label', $edit ? 'Modifier la LAN' : 'Créer une LAN')

@section('form')
    <form enctype="multipart/form-data" method="POST" action="{{ $edit ? route('lan.update', $lan) : route('lan.store') }}">
        @method($edit ? 'PUT' : 'POST')
        @csrf

        <!-- Nom de la LAN -->

        <div class="form-group">
            <label for="nom">Nom de la LAN</label>
            <input type="text"
                   id="nom"
                   name="nom"
                   placeholder="Ma Super LAN perso"
                   value="{{ old('nom', $edit ? $lan->nom : '') }}"
                   class="form-control @error('nom') is-invalid @enderror"
                   autofocus>

            @error('nom')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Date de la LAN -->

        <div class="form-group">
            <label for="date">Date de la LAN</label>
            <input type="datetime-local"
                   id="date" name="date"
                   step="{{ 60*15 }}"
                   value="{{ old('date', $edit ? \Carbon\Carbon::parse($lan->date)->format('Y-m-d\TH:i') : date('Y-m-d\TH:i')) }}"
                   class="form-control @error('date') is-invalid @enderror">

            @error('date')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <!-- Nombre max. de participants -->

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
                   value="{{ old('max', $edit ? $lan->max : 100) }}">

            @error('max')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Description de la LAN -->

        <div class="form-group">
            <label for="info">Description de la LAN</label>
            <textarea class="form-control @error('info') is-invalid @enderror"
                      id="info"
                      name="info"
                      rows="10"
                      placeholder="Voici pleins d'informations super utiles sur la LAN.">
                {{ old('info', $edit ? $lan->info : '') }}
            </textarea>

            @error('info')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Image de la LAN -->

        <div class="form-group">
            <label for="image">Image de la LAN</label>
            <input type="file"
                   id="image"
                   name="image"
                   class="form-control @error('image') is-invalid @enderror">

            @error('image')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <!-- Bouton annuler -->

        <a class="btn btn-danger" href="{{ $edit ? route('lan.show', $lan) : route('lan.index') }}">Annuler</a>

        <!-- Bouton confirmer -->

        <input type="submit" class="btn btn-success float-right">
    </form>


    <!-- Bouton supprimer -->

    @if($edit)
        <form method="POST" class="text-center" action="{{ route('lan.destroy', $lan) }}">
            @method('DELETE')
            @csrf

            <input type="submit" class="btn btn-link text-info" onclick="return confirm('Voulez vous VRAIMENT supprimer cette LAN ?')" value="Supprimer la LAN">
        </form>
    @endif

@endsection