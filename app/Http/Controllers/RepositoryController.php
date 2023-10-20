<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepositoryRequest;
use App\Models\Category;
use App\Models\File;
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

        $categories = Category::pluck('name', 'id');
        $data = null;

        return view('repositories.form', compact('data', 'categories'));
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
                
                File::create([
                    'file_name' => $file['file_name'],
                    'mime_type' => $file['mime_type'],
                    'path' => $target_path,
                    'repository_id' => $repository['id'],
                    'size' => $file['size']
                ]);
            }
        }

        return redirect()->route('repositories.index')->withSuccess(__('message.msg_added', ['name' => __('repositories.store')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Repository $repository) {
        $id = $repository->id;
        $data = Repository::with('files')->findOrFail($id);

        $categories = Category::pluck('name', 'id');

        return view('repositories.form', compact('data', 'id', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function edit(Repository $repository) {
        $id = $repository->id;
        $data = Repository::with('files')->findOrFail($id);

        $categories = Category::pluck('name', 'id');

        return view('repositories.form', compact('data', 'id', 'categories'));
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

        return redirect()->route('repositories.index')->withSuccess(__('message.msg_updated', ['name' => __('message.user')]));
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
        $status = 'errors';
        $message = __('global-message.delete_form', ['form' => __('repositories.title')]);

        if ($repository != '') {
            Storage::deleteDirectory('repository/' , $repository->id);

            $repository->delete();
            $status = 'success';
            $message = __('global-message.delete_form', ['form' => __('repositories.title')]);
        }

        if (request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status, $message);
    }
}