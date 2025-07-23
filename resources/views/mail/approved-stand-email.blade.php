<x-mail::message>
# Eat&Drink: Demande de stand approuvé

Salut {{ $name }} .<br>
Votre demande de stand a été accepté. <br>
Vous pourrez donc accéder à votre interface de gestion afin de vous connecter.<br>
Tous ensemble, faisons du festival de cette année une véritable réussite.<br>

<x-mail::button color="success" url="http://localhost:8000">
Connecter vous
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
