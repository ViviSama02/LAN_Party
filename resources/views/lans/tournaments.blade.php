
<!-- Liste des tournois lors de cette LAN -->

@foreach($lan->tournaments as $tournament)
    <a class="col-4 my-2 btn" href="{{ route('tournament.show', $tournament) }}">
        <div class="card shadow">
            <img class="card-img-top" src="https://picsum.photos/1024?random={{ uniqid() }}" alt="Card image cap">
            <div class="card-body text-primary">
                <h5 class="card-title">{{ $tournament->nom }}</h5>
            </div>
        </div>
    </a>
@endforeach

<!-- Bouton pour ajouter un nouveau tournoi -->

@can('update', $lan)
    <div class="col-4 my-2">
        <div class="card shadow bg-warning">
            <form action="{{ route('tournament.create') }}" class="card-body text-primary p-2 shadow">
                <input type="hidden" name="lan" value="{{ $lan->id }}">
                <button type="submit" class="btn">
                    <img class="m-2 w-25 h-25" src="{{ asset('svg/plus-square.svg') }}" alt="Card image cap">
                    <h5 class="card-title">
                        Ajouter un nouveau tournoi
                    </h5>
                </button>
            </form>
        </div>
    </div>
@endcan