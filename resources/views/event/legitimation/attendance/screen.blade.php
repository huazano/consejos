<x-attendance-layout>
    <div class="flex bg-red-500 p-2 text-center text-white font-bold border-b-4 border-yellow-400">
        <div class="px-10">
            <a href="{{route('legitimation.attendance',['event' => $door->location->event->id])}}"><img
                    src="{{asset('svg/siconecta-txt.svg')}}" style="height:40px"></a>
        </div>
        <div class="text-3xl text-center w-full h-full align-middle">
            Consejo Nacional Ordinario XXXII
        </div>
    </div>
    <div class="m-6">
        @livewire('event.legitimation.attendance.screen', ['door' => $door])
    </div>

</x-attendance-layout>
