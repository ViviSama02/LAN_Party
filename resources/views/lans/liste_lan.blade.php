@extends('layouts.app')

@section('content')
<div class="container" style="padding:20px">
    <div class="row">
        <h1 class="title">Liste des LANs à venir :</h1>
    </div>

    @foreach($lans as $lan)
    <div class="row">
        <div class="card centre" style="max-width: 900px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="https://via.placeholder.com/2048" class="card-img" alt="affiche de la lan">
                </div>
                <div class="col">
                    <div class="card-body">
                        <div cl>
                            <a class="btn btn-info text-light float-right" href="{{ route('lan.show', $lan) }}">
                                <img src="{{ asset('svg/visibility-24px.svg') }}" alt="view icon" style="vertical-align: middle;">
                                &nbsp;Voir en détail
                            </a>
                            <h5 class="card-title">{{ $lan->nom }}</h5>
                            <br>
                            <p class="card-text">
                                {{ $lan->info }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
