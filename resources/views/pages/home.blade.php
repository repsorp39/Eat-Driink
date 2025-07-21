@extends("layout.base")

@section('title','Eat&Drink HomePage')

@section("header")
    @include("components.header")
@endsection


@section("content")
    <section class="flex justify-between items-center mt-8">
        <div class="w-1/2">
            <h1 class=" text-4xl font-extrabold mb-2">Eat&Drink: Gigantesque évènement culinaire</h1>
            <p class="text-md leading-8 text-justify">
                L'événement culinaire "Eat&Drink" rassemble de nombreux entrepreneurs (restaurateurs, artisans, etc.) et attire un large public.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum a incidunt, ratione ducimus repellendus fugiat, dicta dignissimos illo qui corporis dolorem dolores inventore. Cupiditate saepe dignissimos fugit rem, temporibus ducimus.
                caecati, aspernatur vitae sit nobis? Libero, numquam nihil dolores delectus et a itaque praesentium vero magnam, expedita ipsa fugit illo beatae, quibusdam aut harum. A excepturi eaque ipsa!
            </p>
        </div>
        <div class="w-[400px] h-[400px]">
            <img class="object-cover" src="/images/stand2.png" alt="">
        </div>
    </section>
    <section>
        @php
            $particularites = [
                [
                    "title" => "🎪 Sécurité Totale",
                    "description" => "Un environnement 100% sécurisé avec équipe de surveillance et accès contrôlés pour une fête en toute tranquillité.",
                    "icon" => "bi bi-shield-check" 
                ],
                [
                    "title" => "🎶 Ambiance Inoubliable",
                    "description" => "DJ live, lumière laser et décoration immersive pour une expérience unique et énergique !",
                    "icon" => "bi bi-apple-music"
                ],
                [
                    "title" => "🍹 Bar & Restauration Variés",
                    "description" => "Cocktails créatifs, snacks gourmands et options vegan—il y en a pour tous les goûts !",
                    "icon" => "bi bi-cup-straw"
                ]
            ];
        @endphp

        <h1 class="text-4xl text-NunitoBold mb-5 text-center">Particularités</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($particularites as $item)
                <div class="card text-white shadow-xl hover:shadow-2xl transition-shadow border-2 border-gray-200 mb-10">
                    <div class="card-body items-center text-center">
                        <i class="{{ $item['icon'] }} text-4xl text-primary"></i>
                        <h3 class="card-title text-xl">{{ $item['title'] }}</h3>
                        <p class="text-gray-500">{{ $item['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        @guest
            <section class="py-4">
                <h1 class="text-4xl text-NunitoBold mb-5 text-center">Êtes-vous un entrepreneur ?</h1>
                <div class="text-center">
                        <a href="{{ route("stand-form") }}" class="btn btn-success">Demander un stand dès maintenant</a>
                </div>
            </section>
        @endguest

       @notadmin
            <section id="contacter" class="py-5  mx-auto">
                <div class="flex gap-5 border-2 border-gray-200 py-5">
                    <div class="w-1/2 flex justify-center flex-col items-center">
                        <div>
                            <img  class="w-[200px] h-[200px]" src="/images/eat-drink-logo.png" alt="">
                        </div>
                    </div>
                    <div class="w-1/2">
                        <h1 class="text-4xl text-NunitoBold mb-5">Contactez-nous </h1>
                        <form action="" class="p-3 ">
                            <div class="mb-3">
                                <label for="email" class="label block">Email</label>
                                <input class="input w-full text-black" type="email" id="email" name="email" placeholder="monemail@email.com" required />
                            </div>
                            <div class="mb-3">
                                <label for="motif" class="label block">Motif</label>
                                <input class="input block w-full text-black" type="text" placeholder="Informations" id="motif" name="motif" required />
                            </div>
                            <div class="mb-3">
                                <label for="description" class="label block">Description</label>
                                <textarea class="input w-full h-[80px] text-black" type="text" id="description" name="description" placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. " required></textarea>
                            </div>
                            <button type="submit" class="btn btn-accent ">Soumettre</button>
                        </form>
                    </div>
                </div>
            </section>
       @endnotadmin
    </section>
@endsection

@section("footer")
    @include("components.footer")
@endsection
