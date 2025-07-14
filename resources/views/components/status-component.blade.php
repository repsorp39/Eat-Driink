@props(["info"  => []])

@php
    $rejected = $info["role"] === "rejected"
@endphp

<div class="min-h-[70vh] grid place-content-center bg-gradient-to-br from-gray-900 to-gray-800 p-4">
    <section class="w-full max-w-2xl mx-auto bg-gray-800 p-6 rounded-2xl shadow-2xl border border-gray-700 
                   transform transition-all hover:scale-[1.01] hover:shadow-xl backdrop-blur-sm
                   relative overflow-hidden before:absolute before:inset-0 {{ !$rejected ? "before:bg-[radial-gradient(circle_at_center,_rgba(74,_222,_128,_0.1)_0,_transparent_70%)]":"before:bg-[radial-gradient(circle_at_center,_rgba(222,_74,_74,_0.1)_0,_transparent_70%)]" }}">
        
        <div class="absolute -top-20 -left-20 w-40 h-40 {{  !$rejected ? "text-emerald-400":"text-red-500" }}rounded-full filter blur-3xl opacity-10 animate-pulse"></div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-10 w-10 rounded-full {{ !$rejected ? "bg-emerald-500/20":"bg-red-500/20" }} flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 motif_rejected" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Demande enregistrée</h2>
            </div>
            
            @if (!$rejected)
                <p class="text-gray-300 mb-6 leading-relaxed">
                    Vous avez effectué une demande de stands le <span class="{{ !$rejected ? "text-emerald-400":"text-red-500" }}">{{\Carbon\Carbon::parse($info["created_at"])->format('d/m/Y à H:i') }}</span>.
                    Vous recevrez une confirmation par email vous informant du statut si elle change. 
                    Jusque là, consultez votre messagerie régulièrement !
                </p>   
            @else
                <p class="text-gray-300 mb-6 leading-relaxed">
                    Vous avez effectué une demande de stands le <span class="text-red-400">{{\Carbon\Carbon::parse($info["created_at"])->format('d/m/Y à H:i') }}</span>.
                    Désolé mais votre demande a été rejeté: Motif<span class="text-gray-400 font-bold"> {{ $info["motif_rejected"] ?? "NA" }} </span>
                </p>   
            @endif
                        
            <table class="w-full mb-6">
                <tbody class="[&_tr]:border-b [&_tr]:border-gray-700 [&_tr:last-child]:border-0">
                    <tr class="hover:bg-gray-700/50 transition-colors">
                        <th class="py-3 px-4 text-left text-gray-400 font-medium w-1/3">Email</th>
                        <td class="py-3 px-4 text-gray-200">{{ $info["email"] }}</td>
                    </tr>
                    <tr class="hover:bg-gray-700/50 transition-colors">
                        <th class="py-3 px-4 text-left text-gray-400 font-medium">Nom complet</th>
                        <td class="py-3 px-4 text-gray-200">{{ $info["owner_fullname"] }}</td>
                    </tr>
                    <tr class="hover:bg-gray-700/50 transition-colors">
                        <th class="py-3 px-4 text-left text-gray-400 font-medium">Entreprise</th>
                        <td class="py-3 px-4 text-gray-200">{{ $info["business_name"] }}</td>
                    </tr>
                    <tr class="hover:bg-gray-700/50 transition-colors">
                        <th class="py-3 px-4 text-left text-gray-400 font-medium">Stand demandé</th>
                        <td class="py-3 px-4 text-gray-200">{{ $info["stand_name"] }}</td>
                    </tr>
                    <tr class="hover:bg-gray-700/50 transition-colors">
                        <th class="py-3 px-4 text-left text-gray-400 font-medium">Statut</th>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1.5 {{  !$rejected ? "text-emerald-400 bg-emerald-500/20 ":"text-red-500 bg-red-500/20 " }} rounded-full py-1.5 px-3 text-sm font-medium">
                                <span class=" w-2 h-2 rounded-full animate-pulse {{  !$rejected ? "bg-emerald-400":"bg-red-500" }}"></span>
                               @if ($rejected)
                                    Rejetée
                               @else
                                    En attente
                               @endif
                            </span>
                        </td>                
                    </tr>
                </tbody>
            </table>
    </section>
</div>
