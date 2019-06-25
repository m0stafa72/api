<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

use Validator;
use Hash;
use Auth;
use Avatar;
use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store','GenrateToken']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function GenrateToken() {

        $min=30;
        $max=45;
        $random = rand($min,$max);

        $token = Str::random($random);

        $unique_user_key = User::where('user_key' , '=' , $token)->first();

            if ($unique_user_key) {
                # code...
               return $this->GenrateToken();
            } else {
                return $token;
            }
            
        
    }

    public function store(Request $request)
    {   
        

        $Validator = Validator::make($request->all(), [
            'name' => ['required','min:4', 'string', 'max:255'],
            'lastname' => ['required','min:4', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if ($Validator->fails()) {
            # code...
            return response()->json([
                'status'   =>    'error',
                'errors'   =>    $Validator->errors(),
            ],401);
        }else {
            $request = $request->all();

            $request["password"] = Hash::make($request['password']);
            $request["avatar"] = Avatar::create($request['email'])->toBase64();

            $token = $this->GenrateToken();
            $request["user_key"] = $token;

            // return response()->json([
            //         'status'   =>  $token,
            //     ],200);

            $user = User::create($request);

            if ($user) {
                # code...
                return response()->json([
                    'status'   =>  'ok',
                ],200);
            }else{
                return response()->json([
                    'status'   =>   'error',
                    'errors'   =>   'خطا در ثبت نام کاربر جدید .'
                ],401);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $key)
    {
        $user = User::where('user_key',$key)->first();

        // return Response()->json([
        //             'request'   =>   $request->all(),
        //         ],200);

        if (Auth::user()->id == $user->id ) {
            # code...

            $update = $user->update($request->all());
            // $save = $user->save();

            if ($update) {
                # code...
                
                return Response()->json([
                    'status'   =>   'ok',
                ],200);
            }else {
                return Response()->json([
                    'status'   =>   'error',
                ],403);
            }
        }
        else {
                return Response()->json([
                    'Auth'   =>   'error',
                ],403);
            }
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

    public function updateAvatar(Request $request,$key)
    {
        # code...
        $img = $request->file('file');
        // $img = $request->file('small_img');
        

        $user = User::where('user_key',$key)->first();

        if (Auth::user()->id == $user->id ) {
            # code...
            

           if ($img) {
                # code...
                 
                $img_name = time().str_random(4).'.'.$img->getClientOriginalExtension();
                $destinationPath = public_path('img\users/'.$user->id.'');
                $final = $img->move($destinationPath, $img_name);

                if ($final) {
                    # code...
                    $item = $user->update([
                        'avatar'  => env('APP_URL').'/img/users/'.$user->id.'/'.$img_name,
                    ]);
                    if ($item) {
                        # code...
                        return response()->json([
                            'status'  => 'ok',
                            'error'   =>  'no errors',
                        ],200);
                    }else{
                        return response()->json([
                            'status'  => 'error',
                            'error'   =>  'no update',
                        ],405);
                    }
                }else{
                    return response()->json([
                        'status'  => 'error',
                        'error'   =>  'no final',
                    ],407);
                }
           
            }
            else{
                return response()->json([
                    'status'  => 'error',
                    'error'   =>  'no file',
                ],406);
            }
           

        }else {
            return Response()->json([
                'error'   =>   'error',
            ],403);
        }
    }
}
