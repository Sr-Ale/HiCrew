<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Aircrafts;
use App\Models\Courses;
use App\Models\Courses_users;
use App\Models\Events;
use App\Models\Flights_users;
use App\Models\Notams;
use App\Models\Parts_courses;
use App\Models\Resources;
use App\Models\Tours;
use App\Models\Tours_parts;
use App\Models\Tours_users;
use App\Models\Users_configs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Http;

class VaController extends Controller
{

    public function dashboard(): View
    {
        //API IVAO
        $data = Http::get('https://api.ivao.aero/v2/tracker/whazzup');
        $ivaodata = $data->json();
        if($ivaodata==NULL){
            $ivao=0;
        }else{
            $ivao = $ivaodata['clients']['pilots'];
            $ivao_map = $ivaodata['clients']['pilots'];
        }


        //API VATSIM
        $vatdata = Http::get('https://data.vatsim.net/v3/vatsim-data.json');
        if($vatdata==NULL){
            $vatsim=0;
        }else{
            $vatsim =  $vatdata['pilots'];
            $vatsim_map =  $vatdata['pilots'];
        }

        $actual = date('Y-m-d');
        $hours = 0;
        $total_flights = 0;

        $tmp = Flights_users::where('id_user',Auth::user()->id)->where('state',3)->get();
        foreach ($tmp as $tmp){
            $hours += strtotime($tmp->finish_flight) - strtotime($tmp->start_flight);
            $total_flights++;
        }

        function segundos_tiempo($segundos) {
            $minutos = $segundos / 60;
            $horas = floor($minutos / 60);
            $minutos2 = $minutos % 60;
            $segundos_2 = $segundos % 60 % 60 % 60;
            if ($minutos2 < 10)
                $minutos2 = '0'.$minutos2;

            if ($segundos_2 < 10)
                $segundos_2 = '0'.$segundos_2;

            if ($segundos < 60) { /* segundos */
                $resultado = round($segundos).' Segundos';
            }
            elseif($segundos > 60 && $segundos < 3600) { /* minutos */
                $resultado = $minutos2
                    .':'
                    .$segundos_2
                    .' Minutos';
            } else { /* horas */
                $resultado = $horas . ':' . $minutos2 . ':' . $segundos_2;
            }
            return $resultado;
        }

        if($hours!=0){
            $hours=segundos_tiempo($hours);
        }

        return view('login_view.home',['ivao_map'=>$ivao_map,'vatsim_map'=>$vatsim_map  ,'vatsim'=>$vatsim,
            'ivao'=>$ivao,'personal_data'=> Users_configs::find(Auth::user()->id),'event'=> Events::where('active','1')->get(),
            'notam' => Notams::where('date_close','>',$actual)->get(),
            'total_flights'=>$total_flights,'hours'=>$hours]);
    }
    public function central(): View
    {
        $total_flights = 0;
        $id_flight_open=0;

        $tmp = Flights_users::where('id_user',Auth::user()->id)->where('state','<',2)->get();
        foreach ($tmp as $tmp){
            $total_flights++;
            $id_flight_open=$tmp;
        }


        return view('login_view.central',['id_flight_open'=>$id_flight_open,'flight_active'=>$total_flights,'personal_data'=> Users_configs::find(Auth::user()->id)]);
    }

    public function central_ubication(Request $request)
    {
        $aux = Users_configs::find(Auth::user()->id);

        $aux->ubication = $request->oaci;

        $aux->save();


        return back();
    }

    public function central_hub(Request $request)
    {
        $aux = Users_configs::find(Auth::user()->id);

        $aux->hub = $request->hub;
        $aux->ubication = $request->hub;

        $aux->save();


        return back();
    }

    public function central_cancel(Request $request,$id)
    {
        $aux = Flights_users::find($id);
        if($aux == NULL){
            return abort(404);
        }
        if($aux->id_user == Auth::user()->id){
        $aux->delete();
        }else{
            return abort(404);
        }
        return back();
    }

    public function central_manual(Request $request)
    {
        $aux = new Flights_users;

        $aux->id_user = Auth::user()->id;
        $aux->callsign = $request->callsign;
        $aux->departure = $request->departure;
        $aux->arrival = $request->arrival;
        $aux->aircraft = $request->aircraft;
        $aux->type = 1;
        $aux->red = 3;
        $aux->state = 2;
        $aux->start_flight = $request->open;
        $aux->finish_flight = $request->close;
        $aux->user_comments = $request->comment;

        $aux->save();

        return redirect()->route('dashboard');
    }

    public function dispatch_charter(): View
    {
        return view('login_view.dispatch_charter',['personal_data'=> Users_configs::find(Auth::user()->id)]);
    }

    public function dispatch_scheduled(): View
    {
        return view('login_view.fleet',['aircrafts' => Aircrafts::all()]);
    }

    public function central_report(Request $request)
    {
        $aux = new Flights_users;

        $aux->id_user = Auth::user()->id;
        $aux->callsign = $request->fltnum;
        $aux->departure = $request->orig;
        $aux->arrival = $request->dest;
        $aux->aircraft = $request->type;
        $aux->type = 1;
        $aux->red = $request->red;
        $aux->state = 0;

        $aux->save();

        return redirect()->route('central');
    }

    public function fleet(): View
    {
        return view('login_view.fleet',['aircrafts' => Aircrafts::all()]);
    }

    public function resources(): View
    {
        return view('login_view.resources',['liveries' => Resources::where('type','0')->get(),'documents' => Resources::where('type','1')->get(),'checklist' => Resources::where('type','2')->get()]);
    }

    public function academy(): View
    {
        return view('login_view.academy',['courses' => Courses::all()]);
    }

    public function course($id): View
    {
        return view('login_view.part_course',['academy' => Courses::where('id',$id)->get(),'courses' => Parts_courses::where('id_courses',$id)->get()]);
    }

    public function course_view($type,$id): View
    {
        return view('login_view.course',['courses' => Parts_courses::where('id_courses',$type)->where('parts',$id)->get()]);
    }

    public function course_create(Request $request)
    {
        $aux = new Courses_users();

        $aux->id_parts = $request->part;
        $aux->id_courses = $request->id;
        $aux->id_user = $request->user_id;

        $aux->save();

        return back();
    }

    public function tours(): View
    {
        $actual = date('Y-m-d');
        return view('login_view.tours',['tours'=>Tours::where('date_close','>',$actual)->get()]);
    }

    public function tours_select($id): View
    {
        return view('login_view.tours_show',['tours'=>Tours::where('id',$id)->get()
        ,"parts"=>Tours_parts::where('id_tour',$id)->orderBy('parts','ASC')->get(),
            "parts_modal"=>Tours_parts::where('id_tour',$id)->orderBy('parts','ASC')->get(),
            "user_parts"=>Tours_users::where('id_user',Auth::user()->id)->where('id_tour',$id)->get()]);
    }

    public function tours_edit_user(Request $request,$id)
    {
        $aux = Tours_users::find($id);


        $aux->id_user = Auth::user()->id;
        $aux->id_part = $request->leg;
        $aux->id_tour = $request->tour;
        $aux->comment_user = $request->comment;
        $aux->dep_time = $request->departure;
        $aux->arr_time = $request->arrival;
        $aux->stats = 0;
        $aux->save();

        return back();
    }

    public function tours_register(Request $request)
    {
        $aux = new Tours_users;
        $aux->id_user = Auth::user()->id;
        $aux->id_part = $request->leg;
        $aux->id_tour = $request->tour;
        $aux->comment_user = $request->comment;
        $aux->dep_time = $request->departure;
        $aux->arr_time = $request->arrival;
        $aux->save();

        return back();
    }



}
