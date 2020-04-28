@extends('global_template')

@section('contenu')
<div class="bg-primary text-light" style="height: 250px;">
    <div class="container">
        <div class="row">
            <h1 class="title centre" style="margin-top: 50px;">Toutes les LANs au même endroit</h1>
        </div>
        <div class="row">
            <a class="btn btn-secondary centre" href="/liste">Voir les LANs</a>
        </div>
    </div>
</div>
<div class="shadow-top">
    <div class="container" style="padding:20px 0">
        <div class="row">
            <h1 class="title">Actualités</h1>
        </div>
        <div class="row" style="padding:20px 0">
            <div class="col">
                <div class="card" style="height: 100%;">
                    <div class="card-header">
                        Toujours en travaux
                    </div>
                    <div class="card-body">
                        <p class="card-text">L'application est en cours de développement.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="height: 100%;">
                    <div class="card-header">
                        Toujours en travaux
                    </div>
                    <div class="card-body">
                        <p class="card-text">Accedebant enim eius asperitati, ubi inminuta vel laesa amplitudo
                            imperii dicebatur, et iracundae suspicionum quantitati proximorum cruentae blanditiae
                            exaggerantium incidentia et dolere inpendio simulantium, si principis periclitetur vita,
                            a cuius salute velut filo pendere statum orbis terrarum fictis vocibus exclamabant.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="height: 100%;">
                    <div class="card-header">
                        Toujours en travaux
                    </div>
                    <div class="card-body">
                        <p class="card-text">L'application est en cours de développement.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
