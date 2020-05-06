@extends('layouts.app')
@section('title', 'Tournoi')

@section('content')
    <h3>{{ $tournament->name }}</h3>

    <a href="{{ route('tournament.index') }}" class="btn btn-primary">Retour</a>

    <form action="{{ route('tournament.destroy', $tournament->id) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">
            Supprimer
        </button>
    </form>
@endsection