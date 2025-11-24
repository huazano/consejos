<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::middleware(['changepassword'])->group(function () {
        Route::middleware(['permission:Administrator'])->group(function () {
            Route::get('/usuarios', [UsersController::class, 'index'])->name('users.index');
            Route::get('/usuarios/{id}', [UsersController::class, 'edit'])->name('users.edit');
        });
    });
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::middleware(['permission:Administrator'])->get('/fotos', [EventController::class, 'guestsPhotos'])->name('photos.index');
});

/* Legitimaciones */
Route::middleware(['auth:sanctum', 'verified', 'changepassword'])->group(function () {
    Route::get('/legitimaciones', [EventController::class, 'legitimations'])->name('legitimation.index');


    Route::get('/legitimaciones/crear', [EventController::class, 'createLegitimation'])->name('legitimation.create');
    Route::get('/legitimaciones/asistencia/puerta/{door}', [EventController::class, 'legitimationAttendanceScreen'])->name('legitimation.attendance.screen');
    Route::get('/legitimaciones/padron/{event}', [EventController::class, 'legitimationGuests'])->name('legitimation.guests');
    Route::get('/legitimaciones/sedes/{event}', [EventController::class, 'legitimationLocations'])->name('legitimation.locations');
    Route::get('/legitimaciones/sedes/{event}/{location}', [EventController::class, 'legitimationLocation'])->name('legitimation.locations.location');
    Route::get('/legitimaciones/configuracion/{event}', [EventController::class, 'legitimationConfiguration'])->name('legitimation.configuration');
    Route::get('/legitimaciones/asistencia/{event}', [EventController::class, 'legitimationAttendance'])->name('legitimation.attendance');
    Route::middleware(['permission:Jurídico'])->group(function () {
        Route::get('/legitimaciones/votacion/consolidado/{event}', [EventController::class, 'legitimationVottingConsolidate'])->name('legitimation.votting.consolidate');
        Route::get('/legitimaciones/votacion/final/{event}', [EventController::class, 'legitimationVottingJuridico'])->name('legitimation.votting.juridico');
        Route::get('/legitimaciones/votacion/final/{event}/{location}', [EventController::class, 'legitimationVottingLocationJuridico'])->name('legitimation.votting.locationjuridico');
    });
    Route::get('/legitimaciones/votacion/{event}', [EventController::class, 'legitimationVotting'])->name('legitimation.votting');
    Route::get('/legitimaciones/votacion/{event}/{location}', [EventController::class, 'legitimationVottingLocation'])->name('legitimation.votting.location');
    Route::get('/legitimaciones/seccion/{event}', [EventController::class, 'legitimationVottingSeccion'])->name('legitimation.vottingseccion');
    Route::get('/legitimaciones/seccion/{event}/{location}/{door}', [EventController::class, 'legitimationVottingSeccionLocation'])->name('legitimation.votting.locationseccion');
    Route::get('/legitimaciones/equipo-de-trabajo/{event}', [EventController::class, 'legitimationTeamwork'])->name('legitimation.teamwork.index');

    Route::get('/legitimaciones/evidencia/{event}', [EventController::class, 'legitimationEvidence'])->name('legitimation.evidence.index');
    Route::get('/legitimaciones/evidencia/{event}/{evidence}', [EventController::class, 'legitimationEvidenceEdit'])->name('legitimation.evidence.edit');
    Route::get('/evidencias', [EventController::class, 'legitimationEvidenceTypes'])->name('legitimation.evidence.types');
    Route::get('/evidencias/crear', [EventController::class, 'legitimationEvidenceTypesCreate'])->name('legitimation.evidence.types.create');
    Route::get('/evidencias/{evidence}', [EventController::class, 'legitimationEvidenceTypesEdit'])->name('legitimation.evidence.types.edit');
    Route::middleware(['permission:Jurídico'])->group(function () {
        Route::get('/solicitar/evidencias/{event}/{location}', [EventController::class, 'legitimationEvidenceRequired'])->name('legitimation.evidence.required');
    });
    Route::get('/subir/evidencias/{event}/{location}', [EventController::class, 'legitimationEvidenceUpload'])->name('legitimation.evidence.upload');

    Route::get('/legitimaciones/archivo/{event}', [EventController::class, 'legitimationArchive'])->name('legitimation.archive.index');
    Route::middleware(['permission:Jurídico'])->group(function () {
        Route::get('/legitimaciones/archivo/{event}/{location}', [EventController::class, 'legitimationArchiveUpload'])->name('legitimation.archive.upload');
    });

    Route::get('/legitimaciones/credenciales/{event}', [EventController::class, 'credentials'])->name('legitimation.credentials.index');

    Route::get('/legitimaciones/estadisticas/{event}', [EventController::class, 'statistics'])->name('legitimation.statistics');
    Route::get('/legitimaciones/{event}', [EventController::class, 'legitimation'])->name('legitimation.show');
    Route::get('/tester/{location}/{door}', [EventController::class, 'tester'])->name('legitimation.tester');
    Route::middleware(['permission:Administrator'])->get('/reportes/{event}', [ReportController::class, 'index'])->name('legitimation.reports.index');
    Route::get('/puertas/{event}', [ReportController::class, 'doors'])->name('legitimation.doors.index');
});
