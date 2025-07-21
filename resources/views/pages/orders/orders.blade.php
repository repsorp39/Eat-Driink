@extends("layout.base")

@section("header")
    @include("components.header")
@endsection

@section("content")
    <x-list-product-component>
        <h1 class="text-3xl font-extrabold">Vos commandes</h1>
        <p class="text-gray-400">Gardez un suivi sur vos commandes</p>
          <table class="table mt-5 border border-gray-500">
            <thead class=" text-white ">
                <tr class="border border-gray-500 [&_th]:border [&_th]:border-gray-500">
                    <th class="">Commandes</th>
                    <th>Produits</th>
                    <th>Total</th>
                </tr>
            </thead>
            @if (count($ordersList) === 0)
                <td colspan="3" class="text-center p-10 text-gray-400"> Aucune commande pour le moment. </td>
            @endif
            <tbody>
                @foreach ($ordersList as $index => $order)
                    <tr class="border-t border-gray-500" >
                        @php
                            $total = 0
                        @endphp
                            <td class="border border-gray-500">    
                                <div class="text-3xl font-thin opacity-30 tabular-nums"> {{ $index + 1 }} </div>
                            </td>
                            @foreach ($order as $index => $product)
                                <td class="list-row w-full flex my-5 gap-10 ">
                                    <div><img class="size-10 rounded-box" src="{{ $product["image_url"] }}"/></div>
                                    <div class="list-col-grow">
                                        <div>{{ $product["quantite"] }} x {{$product["price"]}}  FCFA</div>
                                        <div class="text-xs uppercase font-semibold opacity-60"> {{ $product["name"] }} </div>
                                    </div>
                                </td>     
                                @php
                                    $total += $product["quantite"] * $product["price"] 
                                @endphp                     
                            @endforeach
                            <td class="border border-gray-500">
                                {{ $total }} FCFA
                            </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
    </x-list-product-component>

@endsection