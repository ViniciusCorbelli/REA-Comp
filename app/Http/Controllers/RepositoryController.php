<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepositoryRequest;
use App\Models\Topic;
use App\Models\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RepositoryController extends Controller {

    public function __construct() {
        $this->authorizeResource(Repository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $repositories = Auth::user()->repositories()->paginate(12);
        return view('repositories.index', compact('repositories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        removeSession(FileUploadController::FILE_KEY);

        $topics = Topic::orderBy('name')->pluck('name', 'id');
        $data = null;

        return view('repositories.form', compact('data', 'topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepositoryRequest $request) {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $repository = Repository::create($data);

        $files = Session::get(FileUploadController::FILE_KEY);
        if (!empty($files)) {
            foreach ($files as $file) {
                $target_path = 'repository/' . $repository->id . '/' . $file['file_name'];
                Storage::move($file['path'], $target_path);
                
                $repository->files()->create([
                    'file_name' => $file['file_name'],
                    'mime_type' => $file['mime_type'],
                    'path' => $target_path,
                    'size' => $file['size']
                ]);
            }
        }

        // Salva os links relacionados
        foreach ($request->input('links') as $link) {
            if (!empty($link)) {
            $repository->links()->create(['url' => $link]);
            }
        }

        return redirect()->route('repositories.index')->withSuccess(__('repositories.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Repository $repository) {
        $id = $repository->id;
        $data = Repository::with(['files', 'links'])->findOrFail($id);

        $topics = Topic::pluck('name', 'id');

        return view('repositories.form', compact('data', 'id', 'topics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function edit(Repository $repository) {
        $id = $repository->id;
        $data = Repository::with(['files', 'links'])->findOrFail($id);

        $topics = Topic::pluck('name', 'id');

        return view('repositories.form', compact('data', 'id', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function update(RepositoryRequest $request, Repository $repository) {
        $id = $repository->id;
        $repository = Repository::findOrFail($id);

        $repository->fill($request->all())->update();

        // Atualiza os links relacionados
        $repository->links()->delete(); // Remove todos os links associados
        foreach ($request->input('links') as $link) {
            if (!empty($link)) {
                $repository->links()->create(['url' => $link]);
            }
        }

        return redirect()->route('repositories.index')->withSuccess(__('repositories.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository) {
        $id = $repository->id;
        $repository = Repository::findOrFail($id);

        Storage::deleteDirectory('repository/' , $repository->id);

        $repository->delete();

        return redirect()->back()->with('success', __('global-message.delete_form', ['form' => __('repositories.title')]));
    }
}
