<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavorityCommentRequest;
use App\Models\FavorityComment;
use Illuminate\Support\Facades\Auth;

class FavorityCommentController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FavorityCommentRequest $request) {
        $favority = FavorityComment::where('comment_id', $request->input('comment_id'))->where('user_id', Auth::user()->id);
        if ($favority->first()) {
            $favority->delete();
            return response()->json(['success' => true, 'action' => 'delete']);
        }

        FavorityComment::create([
            'user_id' => Auth::user()->id,
            'comment_id' => $request->input('comment_id')
        ]);
        return response()->json(['success' => true, 'action' => 'create']);
    }
}
