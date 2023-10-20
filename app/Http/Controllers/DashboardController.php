<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    /*
     * Dashboard Pages Routs
     */
    public function index(Request $request) {

        $files = Auth::user()
            ->repositories()
            ->with('files')
            ->get()
            ->flatMap(function ($repository) {
                return $repository->files;
            });

        $storage = [];
        $storage['used'] = $files->sum('size');
        $storage['total'] = Auth::user()->userProfile()->first()->storage;

        $imageMimes = ['png', 'jpg', 'jpeg', 'svg'];
        $images = $files->whereIn('mime_type', $imageMimes);
        $storage['imagens'] = [
            'size' => $images->sum('size'),
            'count' => $images->count()
        ];

        $videoMimes = ['mp4'];
        $videos = $files->whereIn('mime_type', $videoMimes);
        $storage['videos'] = [
            'size' => $videos->sum('size'),
            'count' => $videos->count()
        ];

        $documentMimes = ['pdf', 'ppt'];
        $documents = $files->whereIn('mime_type', $documentMimes);
        $storage['documents'] = [
            'size' => $documents->sum('size'),
            'count' => $documents->count()
        ];

        $documentOther = array_merge($imageMimes, $videoMimes, $documentMimes);
        $others = $files->whereNotIn('mime_type', $documentOther);
        $storage['others'] = [
            'size' => $others->sum('size'),
            'count' => $others->count()
        ];
    
        return view('dashboards.dashboard', compact('storage'));
    }
}
