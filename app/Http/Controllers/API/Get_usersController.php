<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class Get_usersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('auth:api', ['except' => ['store']]);
    }

    /**
        * seach in users and return response
    **/
    public function search(Request $request , $key){
        $user = User::where('user_key' ,'!=' , $key)
                    ->Where('email','LIKE','%'.$request->search."%")
                    ->get(['avatar','lastname','name','user_key']);
        


        return Response()->json([
            'users'  => $user,
        ],200);

        // ->where('name','LIKE','%'.$request->search."%")
        //              ->orWhere('lastname','LIKE','%'.$request->search."%")
        //              ->orWhere('email','LIKE','%'.$request->search."%")
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser($id)
    {
        //
        $user = User::where('id' , $id)->first(['avatar','lastname','name','user_key']);

        return Response()->json([
            'status'   =>   'ok',
            'user'     =>   $user
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        //
        $user = User::where('user_key' ,'!=' , $key)->get(['avatar','lastname','name','user_key']);

        return Response()->json([
            'users'  => $user,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
