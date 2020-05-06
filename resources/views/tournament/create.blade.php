@extends('layouts.app')

@section('content')
    <form action="{{ route('tournament.store') }}" method="POST">
        @csrf
        <input type="text" class="form-control" placeholder="Nom du tournoi" name="name">

        <button type="submit" class="form-control btn btn-primary">Valider</button>
    </form>
@endsection