<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\chat;
use App\content;
use App\User;
use Auth;

class ChatController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('auth:api', ['except' => ['store']]);
    }
    
    protected function GenrateToken() {

        $min=35;
        $max=45;
        $random = rand($min,$max);

        $token = Str::random($random);

        $unique_chat_key = chat::where('chat_key' , '=' , $token)->first();

            if ($unique_chat_key) {
                # code...
               return $this->GenrateToken();
            } else {
                return $token;
            }    
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
        # code...
       
        $in_user_id = $request->in_user_id;


        if (Auth::user()->id == $in_user_id ) {

            $message = $request->message;

            if ($message != null) {
                # code...

                $out_user_id = $request->out_user_id;
                $chat_key = $request->chat_key;

                // *********
                // save message by chat_key
                // *********
                if ($chat_key != null) {
                    # code...
                    $chat = chat::where('chat_key',$chat_key)->first();
                    
                    if ($chat != null ) {
                        # code...
                        if (($chat->user1 == $in_user_id && $chat->user2 == $out_user_id ) || ($chat->user1 == $out_user_id && $chat->user2 == $in_user_id )) {
                            # code...

                            $content = new content(array(
                                'text'  => $message,
                                'user_id'  => $in_user_id
                            ));

                            $save = $chat->contents()->save($content);

                            if ($save) {
                                # code...
                                return Response()->json([
                                    'status'  =>  'yes'
                                ],200);
                            }else {
                                return Response()->json([
                                    'status'  =>  'error'
                                ],403);
                            }  
                        }else {
                             return Response()->json([
                                'chat'  =>  'no'
                            ],403);
                        }

                        # code...
                        return Response()->json([
                            'in'  =>  'yes'
                        ],200);

                    }else {
                         return Response()->json([
                            'chat'  =>  'not fond'
                        ],403);
                    }

                }
                // *********
                // if chat_key in null first create a chat key and save message
                // *********
                else {
                    $check = chat::where('user1',$in_user_id)->where('user2',$out_user_id)
                                ->orWhere('user2',$in_user_id)->where('user1',$out_user_id)->first();
                    if ($check != null) {
                        # code...
                        /*  
                        *****************
                        */
                        $chat = chat::where('chat_key',$check->chat_key)->first();
                    
                        if ($chat != null ) {
                            # code...
                            if (($chat->user1 == $in_user_id && $chat->user2 == $out_user_id ) || ($chat->user1 == $out_user_id && $chat->user2 == $in_user_id )) {
                                # code...

                                $content = new content(array(
                                    'text'  => $message,
                                    'user_id'  => $in_user_id
                                ));

                                $save = $chat->contents()->save($content);

                                if ($save) {
                                    # code...
                                    return Response()->json([
                                        'status'  =>  'yes'
                                    ],200);
                                }else {
                                    return Response()->json([
                                        'status'  =>  'error'
                                    ],403);
                                }  
                            }else {
                                 return Response()->json([
                                    'chat'  =>  'no'
                                ],403);
                            }

                            # code...
                            return Response()->json([
                                'in'  =>  'yes'
                            ],200);

                        }else {
                             return Response()->json([
                                'chat'  =>  'not fond'
                            ],403);
                        }
                    /*  
                        *****************
                    */


                    }else {
                        
                        $new_chat_key = $this->GenrateToken();

                        $new_chat = new chat(array(
                            'user1'      =>  $in_user_id,
                            'user2'      =>  $out_user_id,
                            'chat_key'   =>  $new_chat_key
                        ));

                        /*
                        **  -  after create a new chat we create new content 
                        */

                        $get_new_chat = $new_chat->save();
                        // return Response()->json([
                        //             'status'   =>  $get_new_chat,
                        //             'new_chat_id'  => $new_chat->id,
                        //         ],200);

                        if ($get_new_chat) {
                            # code...
                            $content = new content(array(
                                'user_id'  => $in_user_id,
                                'text'     => $message,
                            ));
                            /*
                            **  -  save new content with relationship func contents in chat model
                            */
                            $save = $new_chat->contents()->save($content);
                            if ($save) {
                            # code...
                                return Response()->json([
                                    'status'   => 'create new chat and save is ok',
                                ],200);
                            } else {
                                return Response()->json([
                                    'status'   => 'error in create new chat and error in save',
                                ],401);
                            }
                        }else {
                            return Response()->json([
                                'status'   => 'error in create new chat',
                            ],401);
                        }

                    }
                    
                }



            }else {
                return Response()->json([
                    'chat'  =>  'message is empty'
                ],403);
            }



        }else {
             return Response()->json([
                'in'  =>  'no'
            ],403);
        }


    }


    /**
     ** get chats for user_key 
    **/
    // public function getChats(Request $request)
    // {
    //     # code...
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        //
        $user = User::where('user_key' , $key)->first()->id;

        $chats = chat::where('user1',$user)
                     ->orWhere('user2',$user)
                     ->with('latestComment') /// latestComment is a class in chat model
                     ->get();

        
        return Response()->json([
            'status'    =>     'ok',
            'chats'     =>     $chats,
            'count'     =>     count($chats),
            // 'content'   =>     $content
        ],200);

    }

    

    public function getMessages(Request $request)
    {
        # code...
        $chat_key = $request->chat_key;
        $in_user_id  = $request->in_user_id;
        $out_user_key = $request->out_user_key;

        if (Auth::user()->id == $in_user_id ) {
            # code...

            // if chat_key != null , this meens is a chat beatween two user
            if ($chat_key != null ) {
                
                $chat = chat::where('chat_key' , $chat_key)->first();
                if ($chat != null ) {
                    # code...
                    if ($chat->user1 == $in_user_id) {
                        # 
                        $out_user_id = $chat->user2;
                    } else if ($chat->user2 == $in_user_id) {
                        # 
                        $out_user_id = $chat->user1;
                    }
                    $out_user = User::where('id',$out_user_id)->first(['id','name','lastname','avatar','bio']);

                    $messages = $chat->contents;
                    return Response()->json([
                        'status'    =>   'ok',
                        'out_user'  =>    $out_user,
                        'messages'  =>    $messages,
                    ],200);
                }


            }
            // if chat_key is null this meens not yet create a chat beatween this two users
            else if ($out_user_key != null ) {
                # code...

                $out_user_id = User::where('user_key',$out_user_key)->first()->id;
                $out_user = User::where('id',$out_user_id)->first(['id','name','lastname','avatar']);

                $check = chat::where('user1',$in_user_id)->where('user2',$out_user_id)
                             ->orWhere('user2',$in_user_id)->where('user1',$out_user_id)->first();

                if ($check != null  ) {
                    # code...
                    $messages = $check->contents;
                    return Response()->json([
                        'status'    =>   'ok',
                        'out_user'  =>    $out_user,
                        'messages'  =>    $messages,
                    ],200);

                } else {

                     return Response()->json([
                            'status'    =>   'ok',
                            'out_user'  =>    $out_user,
                            'messages'  =>    [],
                        ],200);

                }
            }


        }


    }



}
