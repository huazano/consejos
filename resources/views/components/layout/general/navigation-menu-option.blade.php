<div>
    <li
        class="mt-1 rounded {{request()->routeIs($activeRoute) ? 'text-red-600 hover:text-red-700 bg-gray-200 bg-opacity-80':'text-gray-600 hover:text-red-600 hover:bg-gray-100'}} ">
        <a href="{{$route}}" class="p-2 flex flex-col items-center" {{$onclick != null ? 'onclick='.$onclick:'false'}}>
            <i class="{{$icon}}"></i>
            <span class="text-xs mt-2 font-bold">{{$slot}}</span>
        </a>
    </li>
</div>