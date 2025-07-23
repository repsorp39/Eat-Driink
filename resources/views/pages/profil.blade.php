@extends("layout.base")

@section("header")
    @include("components.header")
@endsection

@section("content")
    <section class="place-content-center">
        <article class="bg-gradient-to-br  my-10 from-gray-900 to-gray-800 p-4 flex justify-start gap-5 items-center place-content-center">
            <div>
                <div class="avatar">
                    <div class="mask mask-squircle w-24">
                        <img src="{{ $user["business_img"] }}" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-4 place-items-center">
                <div class="w-[250px] h-[100px]">
                    <h4 class="uppercase text-gray-600 text-[12px]">Propriétaire</h4>
                    <p> {{ $user["business_name"] }} </p>
                </div>
                <div class="w-[250px] h-[100px]">
                    <h4 class="uppercase text-gray-600 text-[12px]">Nom du stand</h4>
                    <p> {{ $user['stands']["stand_name"] }} </p>
                </div>
                <div class="w-[250px] h-[100px]">
                    <h4 class="uppercase text-gray-600 text-[12px]">Description</h4>
                    <p title="{{ $user["stands"]["description"] }}" class="text-sm"> {{ Str::limit($user["stands"]["description"],100) }} </p>
                </div>
            </div>
        </article>        
        <section class="flex items-center content-center justify-center gap-10">
            <div class="w-1/2 h-[100px] rounded-xl p-4 bg-gray-800">
                <h1 class="text-3xl font-extrabold"> {{ $products }} </h1>
                <strong class="font-light text-emerald-700">Produits</strong>
            </div>
            <div class="w-1/2 rounded-2xl h-[100px] p-4 bg-gray-800">
                <h1 class="text-3xl font-extrabold"> {{ $commandes }} </h1>
                <strong class="font-light text-emerald-700">Commandes</strong>
            </div>
        </section>
    </section>
@endsection

