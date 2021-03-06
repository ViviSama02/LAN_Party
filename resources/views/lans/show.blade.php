@extends('layouts.app')

@section('show')
<div class="row" style="padding:20px 0">
    <div class="col-md-2">
        <img src="{{ $lan->thumbnail() }}" class="card-img" alt="affiche de la lan">
    </div>
    <div class="col">
        <span class="badge badge-info">{{ $lan->users->count() }}/{{ $lan->max }} Participants</span>
        <div>
            {{ $lan->info }}
        </div>

        <h4 class="my-5 text-center">Jeux lors de cette LAN</h4>
        <div class="card-columns">

            <!-- Liste des jeux présents lors de la LAN -->

            @foreach(range(1, 5) as $i)
                <div class="card shadow">
                    <img class="card-img-top" src="https://picsum.photos/1024??random={{ $i }}" alt="Card image cap">
                    <div class="card-body text-primary">
                        <h5 class="card-title">Jeu n°{{ $i }}</h5>
                    </div>
                </div>
            @endforeach

        </div>

        <h4 class="my-5 text-center">Tournois lors de cette LAN</h4>

        <div clas="container-fluid">
            <div class="row d-flex flex-fill">
                @include('lans.tournaments')
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="bg-primary text-light" style="height: 225px;">
    <div class="container">
        <div class="row">
            <h1 class="title" style="margin-top: 100px;">{{ $lan->nom }}</h1>
        </div>
        <div class="row">
            <h4 class="title" style="margin-top: -10px;">
                {{ \Carbon\Carbon::parse($lan->date)->locale('fr')->diffForHumans() }}
            </h4>
        </div>
        <div class="row">
            <small>
                de <strong>{{ $lan->user->name }}</strong>
            </small>
        </div>
    </div>
</div>
<div class="container shadow">
    <div class="row bg-primary text-light" style="padding: 10px; height: 58px;">
        <div class="col">
            <a style="padding-top: 5px;" href="{{ route('lan.show', $lan) }}">Informations</a>
        </div>
        <div class="col">

            <form method="GET" action="{{ route('lan.registration.index', $lan) }}" class="d-inline-block">
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary">Utilisateurs inscrits</button>
                </div>
            </form>

            <div class="float-right">
                @unless($lan->users->contains(Auth::user()))
                <form method="POST" action="{{ route('lan.registration.store', $lan) }}" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-success">Rejoindre la LAN</button>
                </form>
                @else
                <form method="POST" action="{{ route('lan.registration.destroy', $lan) }}" class="d-inline-block">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Se désinscrire de la LAN</button>
                </form>
                @endif

                @can('update', $lan)
                    <form method="GET" action="{{ route('lan.edit', $lan) }}" class="d-inline-block">
                        <div class="form-group">
                            <button type="submit" class="btn btn-link text-warning">Modifier la LAN</button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>

    <!-- Message de status -->

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

    @yield('show')
</div>
@endsection
