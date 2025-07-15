@props(
    [
        "title" => "",
        "data" => [],
        "item_name" => ""
        "head_items" => ""
    ]
)
<div class="px-6 py-4 border-b border-gray-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-gray-900 to-gray-800">
    <div>
        <h2 class="text-2xl font-bold text-white"> {{ $title }} </h2>
        <p class="text-sm text-gray-400">{{ count($data) $item_name }}  </p>
    </div>
                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-800">
                    <thead class="bg-gray-800">
                        <tr>
                            @foreach ($head_items as $item)
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Demandeur</th>> {{ $item }} </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-800">
                        @foreach ($data as $element)
                        <tr 
                            class="hover:bg-gray-800/50 transition-colors duration-150"
                        >
                            <td class="px-6 py-4 whitespace-nowrap"></td>
                        </tr>
                    </tbody>
                </table>
<div>