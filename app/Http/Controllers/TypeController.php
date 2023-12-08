<?php

namespace App\Http\Controllers;

use App\DataTables\TypeDataTable;
use App\Http\Requests\TypeRequest;
use App\Models\Type;

class TypeController extends Controller {

    public function __construct() {
        $this->authorizeResource(Type::class, 'Type');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TypeDataTable $dataTable) {
        $pageTitle = trans('global-message.list_form_title', ['form' => trans('types.title')]);
        $assets = ['data-table'];
        $headerAction = '<a href="' . route('types.create') . '" class="btn btn-sm btn-primary" role="button">' . trans('global-message.add_form_title', ['form' => trans('types.title')]) . '</a>';
        return $dataTable->render('global.datatable', compact('pageTitle', 'assets', 'headerAction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('types.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request) {
        Type::create($request->all());

        return redirect()->route('types.index')->withSuccess(__('types.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param Type $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type) {
        $id = $type->id;
        $data = Type::findOrFail($id);

        return view('types.form', compact('data', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type) {
        $id = $type->id;
        $data = Type::findOrFail($id);

        return view('types.form', compact('data', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, Type $type) {
        $id = $type->id;
        $type = Type::findOrFail($id);

        $type->fill($request->all())->update();

        return redirect()->route('types.index')->withSuccess(__('types.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type) {
        $id = $type->id;
        $type = Type::findOrFail($id);

        $type->delete();

        return redirect()->back()->with('success', __('global-message.delete_form', ['form' => __('types.title')]));
    }
}
