<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    //
    protected $fillable=[
    	'user1',
    	'user2',
    	'chat_key',
    ];

    public function contents()
    {
    	# code...
    	return $this->hasMany('App\content','chat_id');
    }

    public function latestComment()
{
    return $this->hasOne('App\content')->latest();
}
    
}
