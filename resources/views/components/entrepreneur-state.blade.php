@props([
    "filter" => "en attente",
    "requests" => []
])
 <div id="wrapper" class="px-4 sm:px-6 lg:px-8 py-8">
                @if (count($requests) === 0)
                    <div class="text-3xl text-NunintoBold text-center text-gray-500 mb-3">Aucune demande  {{ $filter }} </div>
                @endif
                @if(session("success"))
                    <p class="px-3 py-3 font-medium text-sm shadow-md opacity-80 text-white text-center mb-2 bg-emerald-500/10 rounded-md"> {{session("success") }}</p>
                @endif
                @if(session("error"))
                    <p class="px-3 py-3 font-medium text-sm shadow-md opacity-80 text-white text-center mb-2 bg-red-500/50 rounded-md"> {{session("error") }}</p>
                @endif
                <div class="bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">
                    <!-- Header avec filtres -->
                    <div class="px-6 py-4 border-b border-gray-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-gray-900 to-gray-800">
                        <div>
                            <h2 class="text-2xl font-bold text-white">Gestion des demandes de stands</h2>
                            <p class="text-sm text-gray-400">{{ count($requests) }} demandes {{ $filter }} </p>
                        </div>
                        <div class="flex gap-3 w-full sm:w-auto">
                            <div class="breadcrumbs text-sm">
                            <ul>
                                <li>
                                    <a
                                        href="/admin?filter=en attente"
                                    >
                                        <i class="bi bi-clock text-gray-600"></i>
                                        En attente
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="/admin?filter=approuvé"
                                    >
                                        <i class="text-emerald-500 bi bi-check"></i>
                                        Approuvé
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin?filter=rejeté" class="inline-flex items-center gap-2">
                                        <i class="bi bi-x text-red-600"></i>
                                        Rejeté
                                    </a>
                                </li>
                        </ul>
                    </div>                
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-800">
                    <thead class="bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Demandeur</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Stand</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Crée le</th>
                            @if ($filter === "en attente")
                              <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                            @endif
                            @if ($filter === "rejeté")
                              <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Motif</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-800">
                        @foreach ($requests as $request)
                        <tr 
                            class="hover:bg-gray-800/50 transition-colors duration-150"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 relative">
                                        <img 
                                            class="h-10 w-10 rounded-full object-cover border-2 border-gray-700" 
                                            src="{{ $request['business_img'] }}" 
                                            alt="{{ $request['business_name'] }}"
                                        >
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-white">{{ $request['owner_fullname'] }}</div>
                                        <div class="text-sm text-gray-400">{{ $request['business_name'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white font-medium">{{ $request['stands']['stand_name'] }}</div>
                                <div 
                                    title="{{ $request["stands"]['description'] }}"
                                    class="mt-2 cursor-pointer text-sm text-gray-300 bg-gray-800 p-3 rounded-lg w-[200px] wrap-break-word break-all text-wrap"
                                >
                                    <span 
                                        class="text-gray-500 font-bold mb-2 block"
                                    >Description</span>
                                    {{ Str::limit($request['stands']['description'], 100) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-white">{{ \Carbon\Carbon::parse($request['created_at'])->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($request['created_at'])->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    @if ($filter === "en attente")
                                        <a
                                            href="/admin/approved/?id={{ $request["id"]  }}"
                                            class="btn-accept inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all"
                                        >
                                            <i class="bi bi-check"></i>
                                            Accepter
                                        </a>  
                                        <button 
                                            data-id="{{ $request["id"] }}"
                                            class="btn-reject inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium cursor-pointer rounded-full shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all"
                                        >
                                            <i class="bi bi-x"></i>
                                            Rejeter
                                        </button>  
                                    @endif
                                    @if($filter === "rejeté")
                                        <div 
                                            class="mt-2 cursor-pointer text-sm text-gray-300 bg-gray-800 p-3 rounded-lg w-[200px] wrap-break-word break-all text-wrap"
                                        >
                                            <span 
                                                class="text-gray-500 font-bold mb-2 block"
                                            >Motif de rejet</span>
                                            {{ $request["motif_rejected"] ?? "Non spécifié"}}
                                        </div>                                    
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="modal-accept" class="hidden transition-all ease-in bg-slate-900 border-2 border-white shadow-2xl rounded-md w-[500px] h-[230px] fixed top-[calc(100vh/2-230px/2)] left-[calc(100vw/2-500px/2)]">
        <form  class="p-5" action="/admin/reject" method="GET">
            @csrf
            <h2 class="text-Avenir text-lg font-bold">Rejet de demande</h2>
            <div>
                <label class="label" for="email">Motif de rejet (Facultatif)</label>
                <textarea 
                    type="text" 
                    id="motif" 
                    class="input w-full text-black h-[80px]" 
                    name="motif" 
                ></textarea>
            </div>
            <input type="hidden" name="id" id="user-id" />
            <button type="submit" class="btn btn-error w-full mt-2">Rejeter</button>
            <span id="btn-close" class="absolute top-0 right-0 m-3 cursor-pointer w-8 h-8 rounded-full bg-red-500/20 place-content-center flex flex-col items-center justify-center"><i class="bi bi-x text-red-500 text-lg"></i></span>            
        </form>
    </div>
    @vite(["resources/js/main.js"])