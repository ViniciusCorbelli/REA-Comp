<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Repository;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index(Request $request) {

        $topics = Topic::pluck('name', 'id');
        //$topics->prepend(__('global-message.all'), '');

        return view('index', compact('topics'));
    }

    public function search(Request $request) {
        $repositories = Repository::query()
            ->whereFullText(['title', 'description'], $request->input('q'))
            ->where('topic_id', $request->input('topic_id'))
            ->with('topic')
        ->get();
        
        return response()->json(
            $repositories, 
        );
    }

    public function repository(Request $request, $id) {
        $repository = Repository::findOrFail($id);
        
        return view('repository', compact('repository'));
    }
}
