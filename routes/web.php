<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaController;

use App\Http\Controllers\StaffController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\FileController;

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

Route::get('/', function () {
    return view('public_view.index');
})->name('index');

Route::get('/list',[PublicController::class, 'list'])->name('list');
Route::get('/rules',[PublicController::class, 'rules'])->name('rules');

Route::get('/stats', function () {
    return view('welcome');
})->name('stats');


Route::get('/dashboard',[VaController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/central',[VaController::class, 'central'])->name('central');
    Route::post('/central/ubication', [VaController::class, 'central_ubication'])->name('central_ubication');
    Route::post('/central/hub', [VaController::class, 'central_hub'])->name('central_hub');
    Route::post('/central/manual', [VaController::class, 'central_manual'])->name('central_manual');
    Route::post('/central/cancel/{id}', [VaController::class, 'central_cancel'])->name('central_cancel');

    Route::get('/dispatch/charter',[VaController::class, 'dispatch_charter'])->name('dispatch_charter');
    Route::get('/dispatch/scheduled',[VaController::class, 'dispatch_scheduled'])->name('dispatch_scheduled');
    Route::post('/dispatch/report', [VaController::class, 'central_report'])->name('central_report');


    Route::get('/resources',[VaController::class, 'resources'])->name('resources');
    Route::get('/fleet',[VaController::class, 'fleet'])->name('fleet');
    Route::get('/edit_profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/edit_profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/edit_profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/academy',[VaController::class, 'academy'])->name('academy');
    Route::get('/academy/{id}',[VaController::class, 'course'])->name('course');
    Route::get('/academy/{type}/{id}',[VaController::class, 'course_view'])->name('course_view');
    Route::post('/academy/complete', [VaController::class, 'course_create'])->name('course_create');

    Route::get('/tours',[VaController::class, 'tours'])->name('tours');
    Route::get('/tours/{id}',[VaController::class, 'tours_select'])->name('tours_select');
    Route::post('/tours/register', [VaController::class, 'tours_register'])->name('tours_register');
    Route::post('/tours_edit_user/edit/{id}', [VaController::class, 'tours_edit_user'])->name('tours_edit_user');

});

Route::middleware('permission')->group(function () {
    Route::get('/admin',[StaffController::class, 'admin'])->name('admin');
});

Route::middleware('members')->prefix('members')->group(function () {


    Route::get('/members', [StaffController::class, 'members'])->name('members');
    Route::post('/members/edit/{id}', [StaffController::class, 'members_edit'])->name('members_edit');
    Route::post('/members/delete/{id}', [StaffController::class, 'members_delete'])->name('members_delete');

    Route::get('/notams', [StaffController::class, 'notams'])->name('notams');
    Route::post('/notams/delete/{id}', [StaffController::class, 'notams_delete'])->name('notams_delete');
    Route::post('/notams/create', [StaffController::class, 'notams_create'])->name('notams_create');
    Route::post('/notams/edit/{id}', [StaffController::class, 'notams_edit'])->name('notams_edit');


    Route::get('/resources', [StaffController::class, 'resources'])->name('staff_resources');
    Route::post('/resources/delete/{id}', [StaffController::class, 'resources_delete'])->name('resources_delete');
    Route::post('/resources/create', [StaffController::class, 'resources_create'])->name('resources_create');
    Route::post('/resources/edit/{id}', [StaffController::class, 'resources_edit'])->name('resources_edit');

    Route::get('/files', [FileController::class, 'files'])->name('files');
    Route::post('/files/upload', [FileController::class, 'files_upload'])->name('files_upload');
    Route::post('/files/delete/{id}', [FileController::class, 'files_delete'])->name('files_delete');


    Route::get('/tours', [StaffController::class, 'tours'])->name('staff_tours');
    Route::post('/tours/create', [StaffController::class, 'tours_create'])->name('tours_create');
    Route::post('/tours/delete/{id}', [StaffController::class, 'tours_delete'])->name('tours_delete');
    Route::post('/tours/edit/{id}', [StaffController::class, 'tours_edit'])->name('tours_edit');
    Route::post('/leg/delete/{id}', [StaffController::class, 'leg_delete'])->name('leg_delete');
    Route::post('/leg/edit/{id}', [StaffController::class, 'leg_edit'])->name('leg_edit');
    Route::post('/leg/create', [StaffController::class, 'leg_create'])->name('leg_create');
});

Route::middleware('events')->prefix('events')->group(function () {
    Route::get('/events', [StaffController::class, 'events'])->name('events');
    Route::post('/events/delete/{id}', [StaffController::class, 'events_delete'])->name('events_delete');
    Route::post('/events/create', [StaffController::class, 'events_create'])->name('events_create');
    Route::post('/events/edit/{id}', [StaffController::class, 'events_edit'])->name('events_edit');
});

Route::middleware('operations')->prefix('operations')->group(function () {
    Route::get('/hubs', [StaffController::class, 'hubs'])->name('hubs');
    Route::post('/hubs/delete/{id}', [StaffController::class, 'hubs_delete'])->name('hubs_delete');
    Route::post('/hubs/create', [StaffController::class, 'hubs_create'])->name('hubs_create');
    Route::post('/hubs/edit/{id}', [StaffController::class, 'hubs_edit'])->name('hubs_edit');

    Route::get('/aircraft', [StaffController::class, 'aircraft'])->name('aircraft');
    Route::post('/aircraft/delete/{id}', [StaffController::class, 'aircraft_delete'])->name('aircraft_delete');
    Route::post('/aircraft/create', [StaffController::class, 'aircraft_create'])->name('aircraft_create');
    Route::post('/aircraft/edit/{id}', [StaffController::class, 'aircraft_edit'])->name('aircraft_edit');

    Route::get('/fleet', [StaffController::class, 'fleet'])->name('fleet_staff');
    Route::post('/fleet/delete/{id}', [StaffController::class, 'fleet_delete'])->name('fleet_delete');
    Route::post('/fleet/create', [StaffController::class, 'fleet_create'])->name('fleet_create');
    Route::post('/fleet/edit/{id}', [StaffController::class, 'fleet_edit'])->name('fleet_edit');
});

Route::middleware('academy')->prefix('academy_staff')->group(function () {
    Route::get('/academy', [StaffController::class, 'academy'])->name('academy_staff');
    Route::post('/academy/delete/{id}', [StaffController::class, 'academy_delete'])->name('academy_delete');
    Route::post('/academy/create', [StaffController::class, 'academy_create'])->name('academy_create');
    Route::post('/academy/edit/{id}', [StaffController::class, 'academy_edit'])->name('academy_edit');
    Route::post('/courses/create', [StaffController::class, 'courses_create'])->name('courses_create');
    Route::post('/courses/delete/{id}', [StaffController::class, 'courses_delete'])->name('courses_delete');
    Route::post('/courses/edit/{id}', [StaffController::class, 'courses_edit'])->name('courses_edit');
});

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/rules', [StaffController::class, 'rules'])->name('staff_rules');
    Route::post('/rules/actions/{id}', [StaffController::class, 'rules_action'])->name('rules_action');
    Route::get('/permission', [StaffController::class, 'permission'])->name('permission');
    Route::post('/permission/delete/{id}', [StaffController::class, 'permission_delete'])->name('permission_delete');
    Route::post('/permission/create', [StaffController::class, 'permission_create'])->name('permission_create');
    Route::post('/permission/edit/{id}', [StaffController::class, 'permission_edit'])->name('permission_edit');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
