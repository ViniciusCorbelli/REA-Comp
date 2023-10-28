<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Repository;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index(Request $request) {

        $topics = Topic::pluck('name', 'id');

        return view('index', compact('topics'));
    }

    public function search(Request $request) {
        $repositories = Repository::query()
            ->selectRaw('repositories.*, AVG(rates.score) as score, COUNT(comments.id) as comments, COUNT(favorities.repository_id) as favorities')
            ->whereFullText(['title', 'description'], $request->input('q'))
            ->where('topic_id', $request->input('topic_id'))
            ->with('topic')
            ->leftJoin('rates', 'repositories.id', '=', 'rates.repository_id')
            ->leftJoin('comments', 'repositories.id', '=', 'comments.repository_id')
            ->leftJoin('favorities', 'repositories.id', '=', 'favorities.repository_id')
            ->groupBy('repositories.id')
            ->orderBy('score', 'desc')
            ->orderBy('comments', 'desc')
            ->orderBy('favorities', 'desc')
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
