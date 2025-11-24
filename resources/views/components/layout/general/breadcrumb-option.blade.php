<div>
    <li class="flex items-center text-red-700 hover:text-red-500">
        @if ($route)
        <a href="{{$route}}">{{$name}}</a>
        @else
        <span class="text-gray-600 hover:text-gray-600">{{$name}}</span>
        @endif
        @if ($arrow == 'true')
        <i class="text-sm fas fa-chevron-right mx-3 text-black hover:text-black"></i>
        @endif
    </li>
</div>