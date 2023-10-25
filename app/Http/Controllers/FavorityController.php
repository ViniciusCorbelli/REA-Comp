<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavorityRequest;
use App\Models\Favority;
use Illuminate\Support\Facades\Auth;

class FavorityController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $repositories = Auth::user()->favorities()->paginate(12);
        return view('favorities.index', compact('repositories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FavorityRequest $request) {
        $favority = Favority::where('repository_id', $request->input('repository_id'))->where('user_id', Auth::user()->id);
        if ($favority->first()) {
            $favority->delete();
            return response()->json(['success' => true, 'action' => 'delete']);
        }

        Favority::create([
            'user_id' => Auth::user()->id,
            'repository_id' => $request->input('repository_id')
        ]);
        return response()->json(['success' => true, 'action' => 'create']);
    }
}
