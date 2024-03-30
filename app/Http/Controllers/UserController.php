<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller {
    
    public function __construct() {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable) {
        $pageTitle = trans('global-message.list_form_title', ['form' => trans('users.title')]);
        $assets = ['data-table'];
        $headerAction = '<a href="' . route('users.create') . '" class="btn btn-sm btn-primary" role="button">' . trans('global-message.add_form_title', ['form' => trans('users.title')]) . '</a>';
        return $dataTable->render('global.datatable', compact('pageTitle', 'assets', 'headerAction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request) {
        $request['password'] = bcrypt($request->password);

        User::create($request->all());

        return redirect()->route('users.index')->withSuccess(__('users.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        $id = $user->id;
        $data = User::findOrFail($id);

        return view('users.show', compact('data', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $id = $user->id;
        $data = User::findOrFail($id);

        return view('users.form', compact('data', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user) {
        $id = $user->id;
        $user = User::findOrFail($id);

        $request['password'] = $request->password != '' ? bcrypt($request->password) : $user->password;

        $user->fill($request->all())->update();

        return redirect()->back()->withSuccess(__('users.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $id = $user->id;
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', __('global-message.delete_form', ['form' => __('users.title')]));
    }
}
