<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RateRequest $request) {
        $data = $request->all();

        // Encontre um registro com base nas condições fornecidas ou crie um novo modelo
        $rate = Rate::where('repository_id', $request->input('repository_id'))
            ->where('user_id', Auth::user()->id)
            ->firstOrNew();

        if ($rate->score == $data['score']) {
            $rate->delete();
            return response()->json(['success' => true, 'action' => 'delete']);
        }

        $data['user_id'] = Auth::user()->id;

        $rate->fill($data);
        $rate->save();
        return response()->json(['success' => true, 'action' => 'create']);
    }
}
