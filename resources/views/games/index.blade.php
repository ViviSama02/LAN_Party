@extends('layouts.app')

@section('content')
<div class="container" style="padding:20px">
    <div class="row">
        <h1 class="title">Liste des jeux :</h1>
    </div>
    <div class="row">
        <ul class="list-group" style="margin: auto; min-width: 500px;">
            @foreach($games as $game)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>{{$game->titre_jeu}}</strong>
                <button type="button" class="btn btn-info" style="float: right;">
                    <img src="visibility-24px.svg" alt="view icon" style="vertical-align: middle;">
                </button>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

