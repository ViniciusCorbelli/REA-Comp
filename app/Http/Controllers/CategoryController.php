<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller {

    public function __construct() {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable) {
        $pageTitle = trans('global-message.list_form_title', ['form' => trans('categories.title')]);
        $assets = ['data-table'];
        $headerAction = '<a href="' . route('categories.create') . '" class="btn btn-sm btn-primary" role="button">' . trans('global-message.add_form_title', ['form' => trans('categories.title')]) . '</a>';
        return $dataTable->render('global.datatable', compact('pageTitle', 'assets', 'headerAction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request) {
        Category::create($request->all());

        return redirect()->route('categories.index')->withSuccess(__('message.msg_added', ['name' => __('categories.store')]));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category) {
        $id = $category->id;
        $data = Category::findOrFail($id);

        return view('categories.form', compact('data', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) {
        $id = $category->id;
        $data = Category::findOrFail($id);

        return view('categories.form', compact('data', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category) {
        $id = $category->id;
        $category = Category::findOrFail($id);

        $category->fill($request->all())->update();

        return redirect()->route('categories.index')->withSuccess(__('message.msg_updated', ['name' => __('message.user')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) {
        $id = $category->id;
        $category = Category::findOrFail($id);
        $status = 'errors';
        $message = __('global-message.delete_form', ['form' => __('categories.title')]);

        if ($category != '') {
            $category->delete();
            $status = 'success';
            $message = __('global-message.delete_form', ['form' => __('categories.title')]);
        }

        if (request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status, $message);
    }
}
