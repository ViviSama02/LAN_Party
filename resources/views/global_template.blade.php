<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <!-- logo -->
            <a class="navbar-brand" href="#">AppLan</a>
            <div class="collapse navbar-collapse" id="navbarGlobal">
                <!-- liens -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/liste">Liste des LANs</a>
                    </li>
                </ul>
            </div>
            @isset($_SESSION['Utilisateur'])
                @include('utilisateur.afficher')
            @endisset
            @empty($_SESSION['Utilisateur'])
                @include('utilisateur.connexion')
            @endempty
        </div>
    </nav>
    <div id="contenu">
        @yield('contenu')
    </div>
</body>
</html>
