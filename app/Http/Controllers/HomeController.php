<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Repository;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index(Request $request) {

        $categories = Category::pluck('name', 'id');
        //$categories->prepend(__('global-message.all'), '');

        return view('index', compact('categories'));
    }

    public function search(Request $request) {
        $repositories = Repository::query()
            ->whereFullText(['title', 'description'], $request->input('q'))
            ->where('category_id', $request->input('category_id'))
            ->with('category')
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
