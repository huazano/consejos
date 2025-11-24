@props([
'pagination' => null
])
<div>
    <div class="bg-white shadow-md rounded ">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                    {{$thead}}
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                {{$tbody}}
            </tbody>
        </table>
        @if ($pagination != null && strpos($pagination,'navigation') !== false)
        <div class="py-3 px-6 bg-gray-100">
            {{$pagination}}
        </div>
        @endif
    </div>
</div>