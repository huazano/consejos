<div>
    <x-card icon="fas fa-globe-americas" title="Permisos globales"></x-card>
    @foreach ($event->locations as $location)
    <x-card icon="fas fa-map-marker-alt" title="Sede: {{$location->name}}"></x-card>
    @endforeach
</div>