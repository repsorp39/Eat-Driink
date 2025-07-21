@extends("layout.base")

@section("title","Eat&Drink - Produits")

@section("header")
    @include("components.header")
@endsection

@section("content")
    @if(session("errors"))
        <x-error-message :message="session('errors')" />
    @endif
    @if(session("success"))
        <x-success-message :message="session('success')" />
    @endif
    <x-list-product-component>
     <div class="relative px-6 py-4 border-b border-gray-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-gray-900 to-gray-800">
        <button onclick="my_modal_3.showModal()" class="absolute flex btn btn-light bg-emerald-200 font-bold right-0 top-0 m-2 shadow-lg" >
            <span  class="w-8 h-8 grid place-content-center bg-emerald-500/20 rounded-full ">
                <i class="bi bi-plus-lg text-md" ></i>
            </span>Ajouter
        </button>
        <div>
            <h2 class="text-2xl font-bold text-white">Gestion des produits</h2>
            <p class="text-sm text-gray-400">{{ count($products) }} produits dans votre stand </p>
        </div>   
     </div>     
    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-800">
        <thead class="bg-gray-800">
            <tr class="">
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Produit</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Détails</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Ajouté le</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
    <tbody class="bg-gray-900 divide-y divide-gray-800">
        @foreach ($products as $product)
        <tr 
            class="hover:bg-gray-800/50 transition-colors duration-150"
        >
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 relative">
                        <img 
                            class="h-10 w-10 rounded-full object-cover border-2 border-gray-700" 
                            src="{{ $product["image_url"] }}" 
                            alt="{{ $product['name'] }}"
                        >
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-white">{{  $product['name']}}</div>
                        <div class="text-sm text-gray-400">{{ $product['name']}}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white font-medium bg-emerald-500/20 p-1 rounded-md inline-block">{{ $product['price']}} FCFA </div>
                <div 
                    title="{{  $product['description'] }}"
                    class="mt-2 cursor-pointer text-sm text-gray-300 bg-gray-800 p-3 rounded-lg w-[200px] wrap-break-word break-all text-wrap"
                >
                    <span 
                        class="text-gray-500 font-bold mb-2 block"
                    >Description</span>
                    {{ Str::limit( $product['description'], 100) }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white">{{ \Carbon\Carbon::parse($product['created_at'])->format('d/m/Y') }}</div>
                <div class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($product['created_at'])->format('H:i') }}</div>
            </td>
            <td>
                <a
                    href="{{ route("product-edit",["id" => $product["id"]]) }}"
                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all"
                >
                    <i class="bi bi-pencil-square"></i>
                    Modifier
                </a>  
                <a 
                    href="/products/delete?product_id={{ $product["id"] }}"
                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium cursor-pointer rounded-full shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all"
                >
                    <i class="bi bi-trash"></i>
                    Supprimer
                </a>                 
            </td>
        </tr>
    @endforeach
    </tbody>
 </table>
 
    <div>
        <dialog id="my_modal_3" class="modal">
            <div class="modal-box bg-gray-800">
                <form method="POST" action="{{ route("new-product") }}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="fieldset rounded-box border p-4 [&_div]:mb-3">
                        <legend class="fieldset-legend text-gray-400 text-lg ">Ajouter un produit</legend>
                        <x-input-row
                            name="name"
                            type="text"
                            label="Nom du produit"
                            />
                        <x-input-row
                            name="price"
                            type="number"
                            label="Prix unitaire (FCFA)"
                            />
                        <x-input-row
                            name="description"
                            type="text"
                            label="Description"
                            />
                        <x-input-row
                            name="image_url"
                            type="file"
                            label="Image illustrative (obligatoire)"
                            />
                            <p class="label">MAX 2MB</p>
                    </fieldset>
                    <span onclick="my_modal_3.close()" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</span>
                    <button class="w-full btn btn-success mt-3">Ajouter</button>
                </form>
            </div>
        </dialog>
    </div>
 </x-list-product-component>

@if (count($products) === 0)
    <section class="mt-20 grid place-content-center">
        <div class="flex flex-col items-center justify-center mt-5 font-Montsera text-lg text-center shadow-ghost-content shadow-2xl rounded-2xl w-32 h-32 ">
            <i class="bi bi-ban text-[120px] text-gray-500"></i>
        </div>
    </section>
@endif
@endsection