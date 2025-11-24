<div>
    <div class="flex flex-col">
        <div class="bg-white shadow  rounded p-4">
            <div class="flex">
                <div class="h-48 w-48">
                    <img src="{{$image}}" class="w-48  object-scale-down object-cover h-48 rounded">
                </div>
                <div class="flex-auto ml-3 justify-evenly py-2">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</div>