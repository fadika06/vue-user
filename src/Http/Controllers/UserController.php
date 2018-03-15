<?php

namespace Bantenprov\User\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\User\Facades\UserFacade;

/* Models */
use Bantenprov\User\Models\Bantenprov\User\User;

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
    public function __construct(User $user)
    {
        $this->user = $user;
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
                $q->where('label', 'like', $value)
                    ->orWhere('description', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $response = $query->paginate($perPage);

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
            'label' => 'required|max:16|unique:users,label',
            'description' => 'max:255',
        ]);

        if($validator->fails()){
            $check = $user->where('label',$request->label)->whereNull('deleted_at')->count();

            if ($check > 0) {
                $response['message'] = 'Failed, label ' . $request->label . ' already exists';
            } else {
                $user->label = $request->input('label');
                $user->description = $request->input('description');
                $user->save();

                $response['message'] = 'success';
            }
        } else {
            $user->label = $request->input('label');
            $user->description = $request->input('description');
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

        if ($request->input('old_label') == $request->input('label'))
        {
            $validator = Validator::make($request->all(), [
                'label' => 'required|max:16',
                'description' => 'max:255',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'label' => 'required|max:16|unique:users,label',
                'description' => 'max:255',
            ]);
        }

        if ($validator->fails()) {
            $check = $user->where('label',$request->label)->whereNull('deleted_at')->count();

            if ($check > 0) {
                $response['message'] = 'Failed, label ' . $request->label . ' already exists';
            } else {
                $user->label = $request->input('label');
                $user->description = $request->input('description');
                $user->save();

                $response['message'] = 'success';
            }
        } else {
            $user->label = $request->input('label');
            $user->description = $request->input('description');
            $user->save();

            $response['message'] = 'success';
        }

        $response['status'] = true;

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
