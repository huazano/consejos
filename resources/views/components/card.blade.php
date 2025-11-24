<div>
    <div class="rounded shadow bg-white mb-5">
        @if ($title)
        <div class="flex justify-between border-b border-gray-200 px-6 py-3">
            <div>
                <i class="{{$icon}} text-{{$color}}-500 mr-2"></i>
                <span class="font-bold text-gray-700 text-lg">{{$title}}</span>
            </div>
        </div>
        @endif
        <div class="px-{{$px}} py-{{$py}} text-gray-600">
            {{$slot}}
        </div>

        @if ($footer)
        <div class="border-t border-gray-200 px-5 py-3">
            {{$footer}}
        </div>
        @endif
    </div>
</div>