<?php

namespace App\Http\Controllers;

use App\DataTables\TopicDataTable;
use App\Http\Requests\TopicRequest;
use App\Models\Topic;

class TopicController extends Controller {

    public function __construct() {
        $this->authorizeResource(Topic::class, 'Topic');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TopicDataTable $dataTable) {
        $pageTitle = trans('global-message.list_form_title', ['form' => trans('topics.title')]);
        $assets = ['data-table'];
        $headerAction = '<a href="' . route('topics.create') . '" class="btn btn-sm btn-primary" role="button">' . trans('global-message.add_form_title', ['form' => trans('topics.title')]) . '</a>';
        return $dataTable->render('global.datatable', compact('pageTitle', 'assets', 'headerAction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('topics.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request) {
        Topic::create($request->all());

        return redirect()->route('topics.index')->withSuccess(__('topics.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic) {
        $id = $topic->id;
        $data = Topic::findOrFail($id);

        return view('topics.form', compact('data', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic) {
        $id = $topic->id;
        $data = Topic::findOrFail($id);

        return view('topics.form', compact('data', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, Topic $topic) {
        $id = $topic->id;
        $topic = Topic::findOrFail($id);

        $topic->fill($request->all())->update();

        return redirect()->route('topics.index')->withSuccess(__('topics.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic) {
        $id = $topic->id;
        $topic = Topic::findOrFail($id);

        $topic->delete();

        return redirect()->back()->with('success', __('global-message.delete_form', ['form' => __('topics.title')]));
    }
}
