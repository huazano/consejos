<div>
    <a {{ $attributes->merge(['class' => "font-bold text-$color-600 hover:text-$color-800 ".$class]) }} href="{{$href}}"
        {{$download !== false ? 'download':''}} @if ($target) target="{{$target}}" @endif>{{$slot}}</a>
</div>