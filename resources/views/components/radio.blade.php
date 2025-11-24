<div>
    <label class="inline-flex items-center mt-3">
        <input type="radio" value="{{$value}}" class="form-radio h-5 w-5 text-{{$color}}-600" name="{{$name}}"
            {{$checked != null ? 'checked':''}} {{$model != null ? 'wire:model='.$model:''}}><span
            class="ml-2 text-gray-700">{{$slot}}</span>
    </label>
</div>