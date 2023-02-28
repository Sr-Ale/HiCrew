<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Aircrafts;
use App\Models\Content_html;
use App\Models\Courses;
use App\Models\Courses_users;
use App\Models\Events;
use App\Models\Fleets;
use App\Models\Hubs;
use App\Models\Notams;
use App\Models\Parts_courses;
use App\Models\Permission;
use App\Models\Resources;
use App\Models\Tours;
use App\Models\Tours_parts;
use App\Models\Tours_users;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function admin(): View
    {
        return view('staff_view.admin');
    }

    public function notams(): View
    {
        return view('staff_view.notams',['notams' => Notams::orderBy('id', 'DESC')->get(),'notams_modals' => Notams::orderBy('id', 'DESC')->get()]);
    }

    public function notams_delete(Request $request,$id)
    {
        $aux = Notams::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('notams');
    }

    public function notams_create(Request $request)
    {
        $aux = new Notams;

        $aux->name = $request->name;
        $aux->description = $request->desc;
        $aux->date_open = $request->open;
        $aux->date_close = $request->close;

        $aux->save();

        return redirect()->route('notams');
    }

    public function notams_edit(Request $request,$id)
    {
        $aux = Notams::find($id);

        $aux->name = $request->name;
        $aux->description = $request->desc;
        $aux->date_open = $request->open;
        $aux->date_close = $request->close;

        $aux->save();

        return redirect()->route('notams');
    }


    public function resources(): View
    {
        return view('staff_view.resources',['liveries' => Resources::where('type','0')->get(),'documents' => Resources::where('type','1')->get(),'checklist' => Resources::where('type','2')->get(),'resources_modals' => Resources::orderBy('id', 'DESC')->get()]);
    }

    public function resources_delete(Request $request,$id)
    {
        $aux = Resources::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('staff_resources');
    }

    public function resources_create(Request $request)
    {
        $aux = new Resources;

        $aux->name = $request->name;
        $aux->type = $request->type;
        $aux->url = $request->url;
        $aux->simulator = $request->simulator;

        $aux->save();

        return redirect()->route('staff_resources');
    }

    public function resources_edit(Request $request,$id)
    {
        $aux = Resources::find($id);

        $aux->name = $request->name;
        $aux->type = $request->type;
        $aux->url = $request->url;
        $aux->simulator = $request->simulator;

        $aux->save();

        return redirect()->route('staff_resources');
    }

    public function events(): View
    {
        return view('staff_view.events',['events' => Events::orderBy('id', 'DESC')->get(),'events_modals' => Events::orderBy('id', 'DESC')->get()]);
    }

    public function events_delete(Request $request,$id)
    {
        $aux = Events::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('events');
    }

    public function events_create(Request $request)
    {
        $aux = new Events;

        $aux->name = $request->name;
        $aux->description = $request->desc;
        $aux->url = $request->link;
        $aux->points = $request->points;
        $aux->day_event = $request->day;
        if($request->state == 1){
            $aux->active = $request->state;
        }else{
            $aux->active = '0';
        }

        $aux->save();

        return redirect()->route('events');
    }

    public function events_edit(Request $request,$id)
    {
        $aux = Events::find($id);

        $aux->name = $request->name;
        $aux->description = $request->desc;
        $aux->url = $request->link;
        $aux->points = $request->points;
        $aux->day_event = $request->day;
        if($request->state == 1){
            $aux->active = $request->state;
        }else{
            $aux->active = '0';
        }

        $aux->save();

        return redirect()->route('events');
    }

    public function rules(): View
    {
        return view('staff_view.rules',['rules' => Content_html::all()]);
    }

    public function rules_action(Request $request,$id)
    {
        $aux = Content_html::find($id);

        if($aux == null){

            $aux2 = new Content_html;
            $aux2->id = '1';
            $aux2->description = $request->rules;
            $aux2->save();
        }else{
            $aux->description = $request->rules;
            $aux->save();
        }



        return redirect()->route('rules');
    }

    public function hubs(): View
    {
        return view('staff_view.hubs',['hubs' => Hubs::all(),'hubs_modals' => Hubs::orderBy('id', 'DESC')->get()]);
    }

    public function hubs_delete(Request $request,$id)
    {
        $aux = Hubs::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('hubs');
    }

    public function hubs_create(Request $request)
    {
        $aux = new Hubs;

        $aux->name = $request->name;
        $aux->oaci = $request->oaci;
        $aux->img_url = $request->url;

        $aux->save();

        return redirect()->route('hubs');
    }

    public function hubs_edit(Request $request,$id)
    {
        $aux = Hubs::find($id);

        $aux->name = $request->name;
        $aux->oaci = $request->oaci;
        $aux->img_url = $request->url;

        $aux->save();

        return redirect()->route('hubs');
    }

    public function aircraft(): View
    {
        return view('staff_view.aircraft',['aircraft' => Aircrafts::all(),'aircraft_modals' => Aircrafts::orderBy('id', 'DESC')->get()]);
    }

    public function aircraft_delete(Request $request,$id)
    {
        $aux = Aircrafts::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('aircraft');
    }

    public function aircraft_create(Request $request)
    {
        $aux = new Aircrafts;

        $aux->name = $request->name;
        $aux->icao = $request->icao;
        $aux->img_url = $request->url;

        $aux->save();

        return redirect()->route('aircraft');
    }

    public function aircraft_edit(Request $request,$id)
    {
        $aux = Aircrafts::find($id);

        $aux->name = $request->name;
        $aux->icao = $request->icao;
        $aux->img_url = $request->url;

        $aux->save();

        return redirect()->route('aircraft');
    }

    public function fleet(): View
    {
        return view('staff_view.fleet',['fleet' => Fleets::all(),'fleet_modals' => Fleets::orderBy('id', 'DESC')->get()]);
    }

    public function fleet_delete(Request $request,$id)
    {
        $aux = Fleets::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('fleet_staff');
    }

    public function fleet_create(Request $request)
    {
        $aux = new Fleets;

        $aux->type = $request->aircraft;
        $aux->hub = $request->hub;
        $aux->name = $request->name;
        $aux->registration = $request->registration;
        $aux->location = $request->location;
        if($request->boocked == 1){
            $aux->boocked = $request->boocked;
        }else{
            $aux->boocked = '0';
        }

        $aux->save();

        return redirect()->route('fleet_staff');
    }

    public function fleet_edit(Request $request,$id)
    {
        $aux = Fleets::find($id);

        $aux->type = $request->aircraft;
        $aux->hub = $request->hub;
        $aux->name = $request->name;
        $aux->registration = $request->registration;
        $aux->location = $request->location;
        if($request->boocked == 1){
            $aux->boocked = $request->boocked;
        }else{
            $aux->boocked = '0';
        }

        $aux->save();

        return redirect()->route('fleet_staff');
    }

    public function academy(): View
    {
        return view('staff_view.courses',['courses' => Courses::all(),
            'courses_modals' => Courses::orderBy('id', 'DESC')->get(),
             'students' => Courses_users::all()]);
    }

    public function academy_delete(Request $request,$id)
    {
        $aux = Courses::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('academy_staff');
    }

    public function academy_create(Request $request)
    {
        $aux = new Courses;
        $aux->name = $request->name;
        $aux->parts = $request->parts;
        $aux->save();

        return redirect()->route('academy_staff');
    }

    public function academy_edit(Request $request,$id)
    {
        $aux = Courses::find($id);


        $aux->name = $request->name;
        $aux->parts = $request->parts;

        $aux->save();

        return redirect()->route('academy_staff');
    }

    public function courses_create(Request $request)
    {
        $aux = new Parts_courses;
        $aux->name = $request->name;
        $aux->id_courses = $request->id_course;
        $aux->parts = $request->parts;
        $aux->html = $request->html;
        $aux->save();

        return redirect()->route('academy_staff');
    }

    public function courses_delete(Request $request,$id)
    {
        $aux = Parts_courses::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('academy_staff');
    }

    public function courses_edit(Request $request,$id)
    {
        $aux = Parts_courses::find($id);


        $aux->name = $request->name;
        $aux->parts = $request->parts;
        $aux->html = $request->html;

        $aux->save();

        return redirect()->route('academy_staff');
    }


    public function members(): View
    {
        return view('staff_view.members',['members' => User::all()]);
    }

    public function members_delete(Request $request,$id)
    {
        $aux = User::find($id);
        if($aux == NULL){
            return abort(404);
        }
        if(Auth::user()->permission()->admin){
            $aux->delete();
        }else{
            return abort(404);
        }
        return redirect()->route('members');
    }

    public function permission(): View
    {
        return view('staff_view.permission',['permission' => Permission::all()]);
    }

    public function permission_delete(Request $request,$id)
    {
        $aux = Permission::find($id);
        if($aux == NULL){
            return abort(404);
        }
        if(Auth::user()->permission()->admin){
            $aux->delete();
        }else{
            return abort(404);
        }
        return redirect()->route('permission');
    }

    public function permission_create(Request $request)
    {
        if(Auth::user()->permission()->admin) {
            $aux = new Permission;

            $aux->id = $request->user;

            if ($request->staff == 1) {
                $aux->staff = $request->staff;
            } else {
                $aux->staff = '0';
            }

            if ($request->valid == 1) {
                $aux->valid = $request->valid;
            } else {
                $aux->valid = '0';
            }

            if ($request->operations == 1) {
                $aux->operations = $request->operations;
            } else {
                $aux->operations = '0';
            }

            if ($request->academy == 1) {
                $aux->academy = $request->academy;
            } else {
                $aux->academy = '0';
            }

            if ($request->events == 1) {
                $aux->events = $request->events;
            } else {
                $aux->events = '0';
            }

            if ($request->members == 1) {
                $aux->members = $request->members;
            } else {
                $aux->members = '0';
            }

            if ($request->admin == 1) {
                $aux->admin = $request->admin;
            } else {
                $aux->admin = '0';
            }

            $aux->save();
        }

        return redirect()->route('permission');
    }

    public function permission_edit(Request $request,$id)
    {
        if(Auth::user()->permission()->admin) {
            $aux = Permission::find($id);


            if ($request->staff == 1) {
                $aux->staff = $request->staff;
            } else {
                $aux->staff = '0';
            }

            if ($request->valid == 1) {
                $aux->valid = $request->valid;
            } else {
                $aux->valid = '0';
            }

            if ($request->operations == 1) {
                $aux->operations = $request->operations;
            } else {
                $aux->operations = '0';
            }

            if ($request->academy == 1) {
                $aux->academy = $request->academy;
            } else {
                $aux->academy = '0';
            }

            if ($request->events == 1) {
                $aux->events = $request->events;
            } else {
                $aux->events = '0';
            }

            if ($request->members == 1) {
                $aux->members = $request->members;
            } else {
                $aux->members = '0';
            }

            if ($request->admin == 1) {
                $aux->admin = $request->admin;
            } else {
                $aux->admin = '0';
            }

            $aux->save();
        }

        return redirect()->route('permission');
    }

    public function members_edit(Request $request,$id)
    {
        if(Auth::user()->permission()->members) {
            $aux = User::find($id);


            $aux->name = $request->name;
            $aux->callsign = $request->callsign;
            $aux->ivao = $request->ivao;
            $aux->vatsim = $request->vatsim;
            $aux->email = $request->email;

            $aux->save();
        }

        return redirect()->route('members');
    }

    public function tours(): View
    {
        return view('staff_view.tours',['tours' => Tours::all(),
            'tours_modals' => Tours::orderBy('id', 'DESC')->get()]);
    }

    public function tours_create(Request $request)
    {
        $aux = new Tours;
        $aux->name = $request->name;
        $aux->description = $request->description;
        $aux->parts = $request->leg;
        $aux->url = $request->url;
        $aux->date_open = $request->open;
        $aux->date_close = $request->close;
        $aux->save();

        return redirect()->route('staff_tours');
    }

    public function tours_delete(Request $request,$id)
    {
        $aux = Tours::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('staff_tours');
    }

    public function tours_edit(Request $request,$id)
    {
        $aux = Tours::find($id);


        $aux->name = $request->name;
        $aux->description = $request->description;
        $aux->parts = $request->leg;
        $aux->url = $request->url;
        $aux->date_open = $request->open;
        $aux->date_close = $request->close;

        $aux->save();

        return redirect()->route('staff_tours');
    }

    public function leg_delete(Request $request,$id)
    {
        $aux = Tours_parts::find($id);
        if($aux == NULL){
            return abort(404);
        }
        $aux->delete();
        return redirect()->route('staff_tours');
    }

    public function leg_create(Request $request)
    {
        $aux = new Tours_parts;
        $aux->departure = $request->departure;
        $aux->id_tour = $request->id_tour;
        $aux->arrival = $request->arrival;
        $aux->description = $request->description;
        $aux->parts = $request->leg;
        $aux->save();

        return redirect()->route('staff_tours');
    }

    public function leg_edit(Request $request,$id)
    {
        $aux = Tours_parts::find($id);


        $aux->departure = $request->departure;
        $aux->arrival = $request->arrival;
        $aux->description = $request->description;
        $aux->parts = $request->leg;

        $aux->save();

        return redirect()->route('staff_tours');
    }

}
