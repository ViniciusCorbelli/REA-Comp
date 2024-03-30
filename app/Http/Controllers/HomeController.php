<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Topic;
use App\Models\Repository;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

    public function index(Request $request) {
        $topics = Topic::orderBy('name')->pluck('name', 'id');
        $types = Type::orderBy('name')->pluck('name', 'id');

        return view('index', compact('topics', 'types'));
    }

    public function search(Request $request) {
        $searchTerm = $request->input('q');

        $repositories = Repository::query()
            ->selectRaw('repositories.id, repositories.title, repositories.description, repositories.topic_id, repositories.created_at, AVG(rates.score) as score, COUNT(comments.id) as comments, COUNT(favorities.repository_id) as favorities')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where(function ($query) use ($searchTerm) {
                    $searchTerm = strtolower($searchTerm);
                    $query->whereRaw('LOWER(title) LIKE ?', ["%{$searchTerm}%"])
                        ->orWhereRaw('LOWER(description) LIKE ?', ["%{$searchTerm}%"]);
                });
            })
            ->when($request->filled('topic_id'), function ($query) use ($request) {
                $query->where('topic_id', $request->input('topic_id'));
            })
            ->when($request->filled('type_id'), function ($query) use ($request) {
                $query->where('type_id', $request->input('type_id'));
            })
            ->with('topic')
            ->leftJoin('rates', 'repositories.id', '=', 'rates.repository_id')
            ->leftJoin('comments', 'repositories.id', '=', 'comments.repository_id')
            ->leftJoin('favorities', 'repositories.id', '=', 'favorities.repository_id')
            ->groupBy('repositories.id', 'repositories.title', 'repositories.description', 'repositories.topic_id', 'repositories.created_at')
            ->orderBy($request->input('order') ?? 'created_at', 'desc')
            ->paginate(12);

        return response()->json(
            $repositories,
        );
    }

    public function repository(Request $request, $id) {
        session_start();
        $repository = Repository::findOrFail($id);

        // Adiciona a visita ao reposotorio caso não existe na session
        if (!isset($_SESSION['visit']) || !isset($_SESSION['visit'][$repository->id])) {
            $visit = $repository->visits()
                ->whereYear('date', date('Y'))
                ->whereMonth('date', date('m'))
                ->first();

            if ($visit) {
                $visit->increment('quantity');
            } else {
                $repository->visits()->create([
                    'date' => Carbon::createFromDate(date('Y'), date('m'), 1)->endOfMonth(),
                    'quantity' => 1,
                ]);
            }
            $_SESSION['visit'][$repository->id] = true;
        }

        // Monta os valores dos graficos
        $startDate = now()->subMonths(12);
        $endDate = Carbon::createFromDate(date('Y'), date('m'), 1)->endOfMonth();

        $visits = $repository->visits()
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get();

        $downloads = $repository->downloads()
            ->select(
                'file_id',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as download_count')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(['file_id', 'month', 'year'])
            ->get();

        $visits_quantities = [];
        $downloads_quantities = [];
        $dates = [];

        $monthlyQuantities = [];

        foreach ($visits as $visit) {
            $monthYear = date('m/Y', strtotime($visit->date));
            $monthlyQuantities[$monthYear] = $visit->quantity;
        }

        $downloadQuantities = [];

        foreach ($downloads as $download) {
            $fileId = $download->file_id;
            $monthYear = $download->month . '/' . str_pad($download->year, 2, '0', STR_PAD_LEFT);

            if (!isset($downloadQuantities[$monthYear])) {
                $downloadQuantities[$monthYear] = [];
            }

            $downloadQuantities[$fileId][$monthYear] = $download->download_count;
        }

        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $monthYear = $currentDate->format('m/Y');

            $dates[] = $monthYear;
            $visits_quantities[] = isset($monthlyQuantities[$monthYear]) ? $monthlyQuantities[$monthYear] : 0;

            foreach ($repository->files as $file) {
                $downloads_quantities[$file->id][] = isset($downloadQuantities[$file->id][$monthYear]) ? $downloadQuantities[$file->id][$monthYear] : 0;
            }

            $currentDate->addMonth();
        }

        return view('repository', compact('repository', 'dates', 'visits_quantities', 'downloads_quantities'));
    }

    public function download(Request $request) {
        session_start();

        $repository_id = $request->input('repository_id');
        $file_id = $request->input('file_id');
        
        if (!isset($_SESSION['download']) || !isset($_SESSION['download'][$repository_id . '|' . $file_id])) {
            $download = new Download();
            if (Auth::user()) {
                $download->user_id = Auth::user()->id;
            }
            $download->repository_id = $repository_id;
            $download->file_id = $file_id;
        
            $download->save();
            $_SESSION['download'][$repository_id . '|' . $file_id] = true;
        }
    
        return response()->json();
    }
}
