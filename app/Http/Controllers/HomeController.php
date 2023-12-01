<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Repository;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index(Request $request) {

        $topics = Topic::orderBy('name')->pluck('name', 'id');

        return view('index', compact('topics'));
    }

    public function search(Request $request) {
        $repositories = Repository::query()
            ->selectRaw('repositories.id, repositories.title, repositories.description, repositories.topic_id, repositories.created_at, AVG(rates.score) as score, COUNT(comments.id) as comments, COUNT(favorities.repository_id) as favorities')
            ->when($request->input('q'), function ($query, $searchTerm) {
                return $query->whereFullText(['title', 'description'], $searchTerm);
            })
            ->where('topic_id', $request->input('topic_id'))
            ->with('topic')
            ->leftJoin('rates', 'repositories.id', '=', 'rates.repository_id')
            ->leftJoin('comments', 'repositories.id', '=', 'comments.repository_id')
            ->leftJoin('favorities', 'repositories.id', '=', 'favorities.repository_id')
            ->groupBy('repositories.id', 'repositories.title', 'repositories.description', 'repositories.topic_id', 'repositories.created_at')
            ->orderBy($request->input('order'), 'desc')
        ->paginate(12);

        return response()->json(
            $repositories, 
        );
    }

    public function repository(Request $request, $id) {
        $repository = Repository::findOrFail($id);
        
        return view('repository', compact('repository'));
    }
}
