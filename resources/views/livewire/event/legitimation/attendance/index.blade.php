<x-table>
    <x-slot name="thead">
        <th class="text-left p-3">Sede</th>
        <th class="text-left p-3">Puerta</th>
        <th class="text-left p-3">Avance</th>
    </x-slot>
    <x-slot name="tbody">
        @foreach ($user_locations as $location)
        @foreach ($location->doors()->get() as $door)
        <tr>
            <td class="p-3"><a href="{{route('legitimation.attendance.screen',['door' => $door->id])}}"
                    class="text-red-600 font-bold hover:text-red-800">{{$location->name}}</a></td>
            <td class="p-3">{{$door->name}}</td>
            <td class="text-left whitespace-nowrap pt-3 px-6">
                <div class="shadow-md w-full bg-gray-200 h-6 mb-3 flex">
                    <div class="bg-green-500 text-xs leading-none text-center text-white h-full py-1 font-bold text-base z-10"
                        style="width: {{$door->guests()->count() > 0 ? round(($door->guests()->where('attendance_door_id',$door->id)->count()/$door->guests()->count())*100,0):'0'}}%">
                        {{$door->guests()->count() > 0 ?
                        (round(($door->guests()->where('attendance_door_id',$door->id)->count()/$door->guests()->count())*100,0)+round(($door->guests()->whereNotNull('attendance_door_id')->where('attendance_door_id','!=',$door->id)->count()/$door->guests()->count())*100,0))
                        :'0'}}%

                    </div>
                    <div class="bg-green-700 text-xs leading-none text-center text-white h-full py-1 font-bold text-base"
                        style="width: {{$door->guests()->count() > 0 ? (round(($door->guests()->whereNotNull('attendance_door_id')->where('attendance_door_id','!=',$door->id)->count()/$door->guests()->count())*100,0)):'0'}}%">
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
        @endforeach
    </x-slot>
</x-table>