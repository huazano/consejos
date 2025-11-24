<div>
    <div class="relative mb-5">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <i class="fa fa-search"></i>
        </span>
        <input wire:model.debounce.{{$debounce}}ms="{{$model}}"
            class="form-input  w-full rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
            placeholder="{{$placeholder}}">
    </div>
</div>