<div>

    <div class="w-full" style="height: 100vh">
        <div class="text-center font-bold text-3xl">
            Control de Accesos - {{$door->location->name}} - {{$door->name}}
        </div>
        <div class="flex" style="height:calc(100vh - 150px)">
            <div class="w-full flex p-3">
                <div class="w-1/3 flex flex-wrap content-center">
                    <div class="w-full relative">
                        <img src="{{asset('img/credencial.png')}}"
                             class="max-w-full m-auto rounded-xl border border-gray-300 shadow-xl"
                             style="max-height: calc(100vh - 330px)">
                        <div class="absolute"
                             style="top: 60%; left:50%;transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);width:30%;">
                            @if ($user)
                                <img src="{{Storage::url($user->profile_photo_path)}}"
                                     class="max-h-full max-w-full max-h-full m-auto shadow-lg border border-gray-300 imgDNE"
                                     alt="">
                            @endif
                        </div>
                        <div class="w-full h-full mt-5">
                            <span class="font-bold text-xl">Asistencia general:
                            {{$door->location->event->guests()->whereNotNull('attendance_door_id')->count()}} de
                            {{$door->location->event->guests()->count()}}
                            </span>
                            <div class=" shadow-md w-full bg-gray-200 h-9 rounded">
                                <div class="bg-green-500 text-xs leading-none text-center text-white h-full rounded py-2 font-bold text-lg"
                                     style="width: {{round(($door->location->event->guests()->whereNotNull('attendance_door_id')->count()/$door->location->event->guests()->count())*100)}}%">
                                    {{round(($door->location->event->guests()->whereNotNull('attendance_door_id')->count()/$door->location->event->guests()->count())*100)}}%
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="w-2/3 ml-6 mt-3" >

                    <div>
                        <div class="-m-5 px-3">
                            <div class="relative z-0 w-full mb-5">
                                <input type="text" placeholder=" " autocomplete="off"
                                       class="pt-3 pb-2 block w-full font-bold px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-gray-400 border-gray-200"
                                       wire:keydown.enter="get_user($event.target.value)"
                                       wire:model.debounce.500ms="qr_code" />
                                <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                                    <i class="fas fa-qrcode"></i> Escanea el código QR
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-6 items-center text-center overflow-y-scroll"  style="height:calc(100vh - 200px)">

                        @foreach($door->fresh()->guests as $guest)
                            <div>
                                <img src="{{Storage::url($guest->profile_photo_path)}}"
                                     class="w-24 h-24 rounded-full m-auto {{$guest->pivot->attendance_door_id == null ? 'grayscale border-4 border-green-300':'border-4 border-green-500'}}"
                                     alt="">
                                <div class="text-gray-800 font-bold">
                                    <div>{{$guest->username}}</div>
                                    <div class="text-sm uppercase">{{$guest->name}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
