<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Aircrafts;
use App\Models\Content_html;
use App\Models\Events;
use App\Models\Files;
use App\Models\Fleets;
use App\Models\Hubs;
use App\Models\Notams;
use App\Models\Resources;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FileController extends Controller
{
    public function files(): View
    {
        return view('staff_view.files',['files' => Files::all()]);
    }

    public function files_upload(Request $request){
        $file=$request->file("file");
        $name = $request->name.".".$file->guessExtension();

        if($file->guessExtension()=="pdf" || $file->guessExtension()=="png" || $file->guessExtension()=="zip"){
            $request->file('file')->storeAs('public/files',$name);

            $aux = new Files;
            $aux->link = $name;
            $aux->save();
            return redirect()->route('files');
        }else{
            return abort(500);;
        }

    }

    public function files_delete(Request $request,$id)
    {
        $aux = Files::find($id);
        if($aux == NULL){
            return abort(404);
        }
        Storage::delete('public/files/'.$aux->link);
        $aux->delete();
        return redirect()->route('files');
    }


}
