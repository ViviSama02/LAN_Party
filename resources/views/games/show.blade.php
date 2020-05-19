@extends('layouts.app')

@section('content')
<div class="bg-primary text-light" style="height: 100px;">
    </div>
    <div class="container shadow" style="margin-top: -33px; height: 500px;">
        <div class="row bg-primary text-light" style="padding: 10px; height: 58px;">
            <button class="btn btn-success">< Retour</button>
            <div class="col">
                <h4 style="padding-top: 5px;">
					{{ $game->titre_jeu }}
				</h4>
            </div>
        </div>

        <div class="row" style="padding:20px 0">
            <div class="col-md-2">
                <img src="test_affiche.png" class="card-img" alt="affiche de la lan">
            </div>
            <div class="col">
                <div class="row">
                    <strong> Type de jeu :</strong>
                </div>
                <div>
                    {{ $game->genre_jeu }}
                </div>
                <div class="row">
                    <strong> Description :</strong>
                </div>
                <div>Possibilité d'ajouter d'autres informations au sujet du jeu.</div>
            </div>
        </div>
    </div>
@endsection
