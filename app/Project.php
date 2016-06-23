<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'name', 'slug', 'data_title'];

    public function users()
    {
    	return $this->belongsTo('App\User');
    }
}
