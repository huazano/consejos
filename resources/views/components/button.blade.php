@props(['class' => ''])
<div>
    @if ($href != null)
    <a href={{$href}} target="{{$target}}">
        <button type=" {{$type}}" {{$click !=null ? 'wire:click=' .$click.'':''}} {{ $attributes->merge(['class' =>
            'text-base bg-'.$color.'-500 text-white font-bold px-3 py-1 rounded
            hover:bg-'.$color.'-600 focus:bg-'.$color.'-600 focus:outline-none focus:ring focus:ring-'.$color.'-600
            focus:ring-opacity-50 '.$class]) }}> @if ($icon !=null) <i class="{{$icon}} mr-2"></i>
            @endif
            {{$slot}}
        </button>
    </a>
    @else
    <button type="{{$type}}" {{$click !=null ? 'wire:click=' .$click.'':''}} {{ $attributes->merge(['class' =>
        'text-base bg-'.$color.'-500 text-white font-bold px-3 py-1 rounded
        hover:bg-'.$color.'-600 focus:bg-'.$color.'-600 focus:outline-none focus:ring focus:ring-'.$color.'-600
        focus:ring-opacity-50 '.$class]) }}>
        @if ($icon != null)
        <i class="{{$icon}} mr-2"></i>
        @endif
        {{$slot}}
    </button>
    @endif
</div>