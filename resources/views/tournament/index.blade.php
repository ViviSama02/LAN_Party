@extends('layouts.app')
@section('title', 'Tournoi')

@section('content')
    Liste des Tournois:

    <ul class="list-group">
    @foreach($tournaments as $tournament)
        <li>
            <a href="{{ route('lan.tournament.show', compact('lan', 'tournament')) }}" class="list-group-item list-group-item-action">
                {{ $tournament->nom }}
            </a>
        </li>
    @endforeach
    </ul>

    <form action="{{ route('lan.tournament.create', $lan) }}" method="GET">
        <button class="btn btn-primary" type="submit">Créer un nouveau tournoi</button>
    </form>
@endsection