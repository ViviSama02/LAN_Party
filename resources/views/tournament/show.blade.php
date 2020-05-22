@extends('layouts.app')
@section('title', 'Tournoi')

@section('content')
<div class="bg-primary text-light" style="height: 225px;">
    <div class="container">
        <div class="row">
            <h1 class="title" style="margin-top: 100px;">{{ $tournament->nom }}</h1>
        </div>
        <div class="row">
            <small>
                Tournoi de la LAN <strong><a href="{{ route('lan.show', $lan) }}">{{ $lan->nom }}</a></strong>
            </small>
        </div>
    </div>
</div>
<div class="container shadow">
    <div class="row bg-primary text-light" style="padding: 10px; height: 58px;">
        <div class="col">
            <h4 style="padding-top: 5px;">Informations</h4>
        </div>
        @isset($userTeam)
        <div class="col">
            <a type="submit" class="btn btn-success" href="{{ route('team.edit', $userTeam) }}">Mon équipe</a>
        </div>
        @endisset
        <div class="col">
            <div class="float-right">

                @unless(Auth::check() && $tournament->isRegistered(Auth::user()))
                <form method="GET" action="{{ route('team.create') }}" class="d-inline-block">
                    @csrf

                    <input type="hidden" name="tournament" value="{{ $tournament->id }}">
                    <button type="submit" class="btn btn-success">Créer une nouvelle équipe</button>
                </form>
                @endif

                @can('update', $lan)
                    <form method="GET" action="{{ route('tournament.edit', $tournament) }}" class="d-inline-block">
                        <div class="form-group">
                            <button type="submit" class="btn btn-link text-warning">Modifier le tournoi</button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="row py-3">
        <div class="col">
            <div class=" alert alert-{{ session('status-type') }}">
                <svg class="bi bi-exclamation-triangle-fill mr-3" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.982 1.566a1.13 1.13 0 00-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 5zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                </svg>
                {{ session('status') }}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col">
            <a class="mt-4 ml-3 btn btn-primary" href="{{ $tournament->url }}">Accéder au Tournoi</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4 class="my-5 text-center">Équipes inscrites</h4>

            <div class="container-fluid">
                <div class="row">
                    @forelse($teams as $team)
                        <div class="col m-3 col-lg-3">
                            <div class="card shadow">
                                <div class="card-header bg-light">

                                    @php
                                    $accepte = $userTeamsStatus[$team->id] ?? null;
                                    $nbNonAcceptes = $team->users()->count() - $team->acceptedUsers()->count();

                                    if($accepte === null)
                                    {
                                        // L'utilisateur ne fait pas parti de la team,
                                        // Et n'a pas demandé à la rejoindre

                                        $icon = 'plus';
                                        $status = 'success';
                                        $route = route('team.join', $team);
                                        $title = 'Demander à rejoindre cette équipe';
                                    }
                                    elseif(!$accepte)
                                    {
                                        // L'utilisateur a demandé à rejoindre la team,
                                        // Mais n'a pas encore été refusé ou accepté

                                        $icon = 'minus';
                                        $status = 'warning';
                                        $route = route('team.leave', $team);
                                        $title = "Annuler la demande de rejoindre l'équipe";
                                    }
                                    else
                                    {
                                        // L'utilisateur fait partie de la team

                                        $icon = 'minus';
                                        $status = 'danger';
                                        $route = route('team.leave', $team);
                                        $title = "Quitter cette équipe";
                                    }
                                    @endphp

                                    <div class="float-right">
                                        <form method="POST" action="{{ $route }}">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-{{ $status }}"
                                                    data-toggle="tooltip"
                                                    data-html="true"
                                                    data-placement="top"
                                                    title="{{ $title }}">
                                                <i class="fa fa-{{ $icon }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <h5>
                                        {{ $team->nom }}
                                    </h5>

                                    <div>
                                        <small>{{ $team->acceptedUsers()->count() }} participants</small>
                                    </div>

                                    @if($nbNonAcceptes > 0)
                                        <div>
                                            <small>{{ $nbNonAcceptes  }} en attente</small>
                                        </div>
                                    @endif
                                </div>

                                @if($team->users->count() != 1 || $team->name != $team->users->first()->name)
                                <ul class="list-group list-group-flush">
                                    @foreach($team->users as $user)
                                        @if($user->pivot->accepte)
                                            <li class="list-group-item">{{ $user->name }}</li>
                                        @elseif($user->id == Auth::id())
                                            <li class="list-group-item">{{ $user->name }} (en attente)</li>
                                        @elseif($team->acceptedUsers->contains(Auth::id()))
                                        @elseif($team->acceptedUsers->contains(Auth::id()))
                                            <li class="list-group-item">{{ $user->name }}

                                                <div class="float-right">

                                                    <form method="POST" action="{{ route('team.accept', compact('team', 'user')) }}" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                                class="btn btn-success"
                                                                data-toggle="tooltip"
                                                                data-html="true"
                                                                data-placement="top"
                                                                title="Accepter">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </form>

                                                    <form method="POST" action="{{ route('team.refuse', compact('team', 'user')) }}" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                                class="btn btn-danger"
                                                                data-toggle="tooltip"
                                                                data-html="true"
                                                                data-placement="top"
                                                                title="Refuser">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    @empty
                    <div class="col font-italic">
                        Aucune équipe inscrite pour l'instant.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="m-5">
                <iframe src="{{ $tournament->localUrl() }}/module?show_standings=1&theme=2"
                        width="100%"
                        height="1000px"
                        frameborder="0"
                        scrolling="auto"
                        allowtransparency="true"
                        id="bracket"
                        class="embed-responsive">

                </iframe>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="{{ route('lan.show', $lan) }}" class="btn btn-primary float-right mb-2">Retour</a>
        </div>
    </div>
</div>
@endsection