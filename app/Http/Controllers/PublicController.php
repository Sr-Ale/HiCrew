<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Content_html;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class PublicController extends Controller
{
    public function list(): View
    {
        return view('public_view.list',['users' => User::orderBy('callsign','ASC')->get(),'permission' => Permission::all()]);
    }

    public function rules(): View
    {
        return view('public_view.rules',['rules' => Content_html::find('1')]);
    }

}
