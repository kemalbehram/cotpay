<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table= 'rating';

    public function user_host()
    {
        return $this->belongsTo('App\User', 'user_host', 'id');
    }

    public function user_comment()
    {
        return $this->belongsTo('App\User', 'user_comment', 'id');
    }
}
