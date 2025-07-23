<x-mail::message>
# Eat&Drink: Demande de stand rejeté ❌

Salut {{ $name }} <br>
Votre demande de stand a été rejetée.<br>

## Motif
{{ $motif }}<br><br>
Merci de l'intérêt que vous avez portez à notre évènement.,<br>
{{ config('app.name') }}
</x-mail::message>
