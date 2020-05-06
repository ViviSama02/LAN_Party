@extends('layouts.app')
@section('title', 'Tournoi')

@section('content')
    Liste des Tournois:

    <ul class="list-group">
    @foreach($tournaments as $tournament)
        <li>
            <a href="{{ route('tournament.show', $tournament) }}" class="list-group-item list-group-item-action">
                {{ $tournament->name }}
            </a>
        </li>
    @endforeach
    </ul>

    <form action="{{ route('tournament.create') }}" method="GET">
        <button class="btn btn-primary" type="submit">Créer un nouveau tournoi</button>
    </form>
@endsection