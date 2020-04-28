@extends('global_template')

@section('contenu')
<div class="container" style="padding:20px">
    <div class="row">
        <h1 class="title">Liste des LANs à venir :</h1>
    </div>
    <div class="row">
        <div class="card centre" style="max-width: 900px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="test_affiche.png" class="card-img" alt="affiche de la lan">
                </div>
                <div class="col">
                    <div class="card-body">
                        <div cl>
                            <button type="button" class="btn btn-info" style="float: right;">
                                <img src="{{ asset('svg/visibility-24px.svg') }}" alt="view icon" style="vertical-align: middle;">
                                &nbsp;Voir en détail
                            </button>
                            <h5 class="card-title">Super LAN venez tous !!!</h5>
                            <br>
                            <p class="card-text">Y aura surement plein de super informations ici qui permettrons de
                                voir en un coup d'oeil si c'est ce qu'on cherche.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
