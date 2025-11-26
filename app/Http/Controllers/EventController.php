<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Door;
use App\Models\Event;
use App\Models\Event\Evidence;
use App\Models\Event\Evidencetype;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use PDF;

class EventController extends Controller
{
    public function legitimations()
    {
        return view('event.legitimation.index');
    }

    public function createLegitimation()
    {
        return view('event.legitimation.create');
    }

    public function legitimation(Event $event)
    {
        return view('event.legitimation.show', compact('event'));
    }

    public function legitimationGuests(Event $event)
    {
        return view('event.legitimation.guests', compact('event'));
    }

    public function legitimationLocations(Event $event)
    {
        return view('event.legitimation.locations', compact('event'));
    }
    public function legitimationLocation(Event $event, Location $location)
    {
        return view('event.legitimation.locations.location', compact('event', 'location'));
    }

    public function legitimationConfiguration(Event $event)
    {
        return view('event.legitimation.configuration', compact('event'));
    }

    public function legitimationStats(Event $event)
    {
        return view('event.legitimation.stats', compact('event'));
    }

    public function legitimationReports(Event $event)
    {
        return view('event.legitimation.reports', compact('event'));
    }

    public function legitimationAttendance(Event $event)
    {
        return view('event.legitimation.attendance', compact('event'));
    }

    public function legitimationAttendanceScreen(Door $door)
    {
        return view('event.legitimation.attendance.screen', compact('door'));
    }

    public function guestDisplayScreen(Event $event)
    {
        return view('event.legitimation.attendance.guest-display', compact('event'));
    }

    public function attendanceStatsScreen(Event $event)
    {
        return view('event.legitimation.attendance.attendance-stats', compact('event'));
    }

    public function legitimationVotting(Event $event)
    {
        return view('event.legitimation.votting', compact('event'));
    }

    public function legitimationVottingLocation(Event $event, Location $location)
    {
        return view('event.legitimation.votting.location', compact('event', 'location'));
    }


    public function legitimationVottingSeccion(Event $event)
    {
        return view('event.legitimation.votting.seccion', compact('event'));
    }

    public function legitimationVottingSeccionLocation(Event $event, Location $location, Door $door)
    {
        return view('event.legitimation.votting.seccionlocation', compact('event', 'location', 'door'));
    }

    public function legitimationVottingJuridico(Event $event)
    {
        return view('event.legitimation.votting.juridico', compact('event'));
    }

    public function legitimationVottingLocationJuridico(Event $event, Location $location)
    {
        return view('event.legitimation.votting.locationjuridico', compact('event', 'location'));
    }

    public function legitimationVottingConsolidate(Event $event)
    {
        return view('event.legitimation.votting.consolidate', compact('event'));
    }

    public function legitimationArchive(Event $event)
    {
        return view('event.legitimation.archive.index', compact('event'));
    }

    public function legitimationArchiveUpload(Event $event, $location = null)
    {
        if ($location != null) {
            $location = Location::find($location);
        }
        return view('event.legitimation.archive.upload', compact('event', 'location'));
    }

    public function legitimationTeamwork(Event $event)
    {
        return view('event.legitimation.teamwork.index', compact('event'));
    }

    public function legitimationEvidence(Event $event)
    {
        return view('event.legitimation.evidence.index', compact('event'));
    }

    public function legitimationEvidenceEdit(Event $event, Evidence $evidence)
    {
        return view('event.legitimation.evidence.edit', compact('event', 'evidence'));
    }

    public function legitimationEvidenceRequired(Event $event, $location)
    {
        $location = Location::find($location);
        return view('event.legitimation.evidence.required', compact('event', 'location'));
    }

    public function legitimationEvidenceUpload(Event $event, $location)
    {
        $location = Location::find($location);
        return view('event.legitimation.evidence.upload', compact('event', 'location'));
    }

    public function legitimationEvidenceTypes()
    {
        return view('event.legitimation.evidence.types');
    }

    public function legitimationEvidenceTypesCreate()
    {
        return view('event.legitimation.evidence.types.create');
    }

    public function legitimationEvidenceTypesEdit(Evidencetype $evidence)
    {
        return view('event.legitimation.evidence.types.edit', compact('evidence'));
    }


    public function statistics(Event $event)
    {
        return view('event.legitimation.statistics', compact('event'));
    }


    public function guestsPhotos()
    {
        $users = User::whereNull('qr')->inRandomOrder()->get();
        foreach ($users as $user) {
            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_URL, "https://siconecta.cfe.mx/webapilegitimacion/Api/Trabajador/?claveEmpleado=" . $user->username);

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string
            $response = curl_exec($ch);

            // close curl resource to free up system resources
            curl_close($ch);

            if ($response !== null) {
                $response = json_decode($response);
                if (isset($response->URLArchivoFoto)) {
                    $url = 'https://siconecta.cfe.mx' . $response->URLArchivoFoto;
                    $image = file_get_contents($url);
                    $file_name = substr($url, strrpos($url, '/') + 1);
                    $stored = Storage::disk('public')->put('profile-photos/' . $file_name, $image);
                    if ($stored) {
                        $user->profile_photo_path = 'profile-photos/' . $file_name;
                        $user->qr = $response->ClaveSindical;
                        $user->save();
                    }
                }
            }
        }
    }


    public function tester(Location $location, Door $door)
    {
        abort(404);
        if (auth()->user()->permission->name != "Administrator" && auth()->user()->permission->name != "Jurídico Global") {
            if (!auth()->user()->locations()->find($door->location_id)) {
                abort(404);
            }
        }

        $users = $door->guests()->whereNotNull('curp')->get();

        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('event.legitimation.tester', compact('users'));

        return $pdf->download('temporales.pdf');
    }

    public function credentials(Event $event)
    {
        return view('event.legitimation.credentials.index', compact('event'));
    }
}
