<?php

namespace Bantenprov\User\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\User\Facades\UserFacade;

/* Models */
use App\User;
use App\Role;

/* Etc */
use Validator;

/**
 * The UserController class.
 *
 * @package Bantenprov\User
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);

            $query = $this->user->orderBy($sortCol, $sortDir);
        } else {
            $query = $this->user->orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('name', 'like', $value)
                    ->orWhere('email', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $response = $query->with('roles')->paginate($perPage);

        return response()->json($response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = $this->user;

        $response['user'] = $user;
        $response['status'] = true;

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->user;

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            $response['message'] = 'Failed, name or email already exists';
        } else {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            $response['message'] = 'success';
        }

        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        $response['user'] = $user;
        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->findOrFail($id);

        $response['user'] = $user;
        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->findOrFail($id);

        if ($request->input('old_name') == $request->input('name') || $request->input('old_email') == $request->input('email'))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'email|required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:users,name',
                'email' => 'email|required|unique:users,email',
            ]);
        }

        if ($validator->fails()) {
            $response['message'] = 'failed, user or email already exist';
        } else {
            if($request->input('password') == ""){
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->save();
            }else{
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));
                $user->save();
            }


            $response['message'] = 'success';
        }

        $response['status'] = true;

        return response()->json($response);
    }

    public function userAddRole($user_id)
    {

        $user = $this->user->with('roles')->find($user_id);
        $roles = $this->role->all();

        $response['roles'] = $roles;
        $response['user'] = $user;
        $response['status'] = true;

        return response()->json($response);

    }

    public function userStoreRole($user_id, Request $request)
    {
        if(\Auth::user()->hasRole(['superadministrator'])){
            if($request->new_role != ''){
                $this->user->find($user_id)->detachRole($request->old_role);
                $this->user->find($user_id)->attachRole($request->new_role);
            }
            $message = 'Update role berhasil.';
            $typem   = 'success';
            $title   = 'Success';
        }else{
            $title   = 'Failed';
            $typem   = 'error';
            $message = 'Anda tidak memiliki hak akses untuk ini.';
        }

        $response['title']      = $title;
        $response['typem']      = $typem;
        $response['message']    = $message;
        $response['status']     = true;

        return response()->json($response);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);

        if ($user->delete()) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        return json_encode($response);
    }
}
