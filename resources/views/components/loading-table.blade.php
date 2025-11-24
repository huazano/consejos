<div>
    <div class="bg-white shadow-md rounded mb-5">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                    @for($x = 0; $x != $columns; $x++)
                    <th class="p-3">
                        <div class="w-full bg-gray-100 rounded text-sm">&nbsp;</div>
                    </th>
                    @endfor
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @for($n = 0; $n != $rows; $n++) <tr class="text-base animate-pulse">
                    @for($x = 0; $x != $columns; $x++)
                    <td class="p-3">
                        <div class="w-full bg-gray-100 rounded text-sm">&nbsp;</div>
                    </td>
                    @endfor
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>