@extends('global_template')

@section('contenu')
<div class="bg-primary text-light" style="height: 225px;">
    <div class="container">
        <div class="row">
            <h1 class="title" style="margin-top: 100px;">Nom de la Lan</h1>
        </div>
        <div class="row">
            <h4 class="title" style="margin-top: -10px;">date de la lan</h4>
        </div>
    </div>
</div>
<div class="container shadow" style="margin-top: -33px; height: 500px;">
    <div class="row bg-primary text-light" style="padding: 10px; height: 58px;">
        <div class="col">
            <h4 style="padding-top: 5px;">Informations</h4>
        </div>
        <div class="col-md-2">

            <button type="button" class="btn btn-success">Rejoindre la LAN</button>
        </div>
    </div>
    <div class="row" style="padding:20px 0">
        <div class="col-md-2">
            <img src="test_affiche.png" class="card-img" alt="affiche de la lan">
        </div>
        <div class="col">
            <span class="badge badge-info">0/32 Participants</span>
            <div>
                Ici seront présente les précisions sur la lan et sa description.
            </div>
        </div>
    </div>
</div>
@endsection
