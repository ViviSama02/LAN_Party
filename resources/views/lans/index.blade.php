@extends('layouts.app')

@section('content')
<div class="container p-4">

    <div class="row">
        <h1 class="title">Liste des LANs à venir :</h1>
    </div>

    @can('create', App\Lan::class)
        <a href="{{ route('lan.create') }}" class="btn btn-primary">Créer une LAN</a>
    @endcan

    @foreach($lans as $lan)
    <div class="row">
        <div class="card centre" style="max-width: 900px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ $lan->thumbnail() }}" class="card-img" alt="affiche de la lan">
                </div>
                <div class="col">
                    <div class="card-body h-100">
                        <a class="btn btn-info text-light float-right" href="{{ route('lan.show', $lan) }}">
                            <img src="{{ asset('svg/visibility-24px.svg') }}" alt="view icon" style="vertical-align: middle;">
                            &nbsp;Voir en détail
                        </a>
                        <h5 class="card-title">{{ $lan->nom }}</h5>
                        <p>
                            {{ \Carbon\Carbon::parse($lan->date)->locale('fr')->diffForHumans() }}
                        </p>
                        <p class="card-text">
                            {{ $lan->info }}
                        </p>
                        <small>Par {{ $lan->user->name }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
