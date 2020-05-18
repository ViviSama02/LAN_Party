<div>
    <!-- formulaire de connexion -->
    <form class="form-inline" method="POST" action="{{ route('login') }}">>
        <input class="form-control" type="text" placeholder="Nom d'utilisateur"
            style="width: 150px; margin-right: 10px;">
        <input placeholder="Mot de passe" style="width: 150px; margin-right: 10px;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <button class="btn btn-secondary" type="submit" style="margin-right: 10px;">Connexion</button>
        <a class="btn btn-success" href='/inscription'>S'inscrire</a>
    </form>
</div>
