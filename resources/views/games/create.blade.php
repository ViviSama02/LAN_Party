@extends('layouts.app')

@section('content')
<div class="bg-primary text-light" style="height: 100px;">
</div>
<div class="container shadow" style="margin-top: -33px;">
    <div class="row bg-primary text-light" style="padding: 10px; height: 58px;">
        <div class="col">
            <h4 style="padding-top: 5px;">Nouveau Jeu</h4>
        </div>
    </div>

    <div class="row" style="padding:20px 0">
        <div class="col" style="max-width: 500px; margin: auto auto">
            <form action="">
                <div class="form-group">
                    <label for="titreField">Nom du jeu</label>
                    <input type="text" class="form-control" id="titreField">
                </div>
                <div class="form-group">
                    <label for="genreField">Genre du jeu</label>
                    <input type="text" class="form-control" id="genreField">
                </div>
                <br>
                <button type="button" class="btn btn-danger">Annuler</button>
                <button type="submit" class="btn btn-success" style="float: right;">Valider</button>
            </form>
        </div>
    </div>
</div>

@endsection
