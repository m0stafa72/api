<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class content extends Model
{
    //
    protected $fillable = [
    	'chat_id',
    	'user_id',
    	'text',
    	'status',
    ];

    protected $hidden = [
        'chat_id', 
        'id', 
        'updated_at', 
        'status', 
    ];

    public function chats()
    {
    	# code...
    	return $this->belongsTo('App\chat','chat_id');
    }
}
