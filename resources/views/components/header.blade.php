<header class="flex items-center justify-between text-NunitoRegular text-lg px-3">
    <div class="w-32 h-32 shrink-0">
        <img src="/images/eat-drink-logo.png" class="w-full h-full object-cover" alt="">
    </div>
    <nav>
        <ul class="flex items-center gap-5">
            <li><a href="#">Nos exposants</a></li>
            <li><a href="#">À propos</a></li>
            <li><a href="/#contacter">Nous contacter</a></li>
            @standwaiting
                <li><a
                     href="{{ route("status") }}"
                     class="{{ request()->routeIs("status") ? "activeLink" : ""}}"
                    >Statut demande</a></li>
            @endstandwaiting
        </ul>
    </nav>
    @auth
        <div>
            <a href="{{ route("logout") }}" class=" btn btn-error me-4"> Se déconnecter</a>
        </div>      
    @endauth
    @guest
        <div>
            <a href="{{ route("stand-form") }}" class=" btn btn-outline  btn-warning me-4"> Demander un stand</a>
            <a href="{{ route("login") }}" class=" btn  btn-success "> Se connecter</a>
        </div>
    @endguest
</header>