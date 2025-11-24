<div>
    <div class="relative z-0 w-full mb-5">
        <input {{$model != null ? ($defer ? 'wire:model.defer':'wire:model'):''}}{{$model != null ? '='.$model:''}}
            type="{{$type}}" placeholder=" " autocomplete="off"
            class="pt-3 pb-2 block w-full font-bold px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-gray-400 border-gray-200"
            value="{{$value}}" />
        <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
            {{$label}}
        </label>
        @if ($model != null)
        <x-jet-input-error for="{{$model}}"></x-jet-input-error>
        @endif
    </div>
</div>