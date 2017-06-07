<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $guarded = [];

    public function author() {
      return $this->belongsTo('App\User','from_user');
    }

    public function blog() {
      return $this->belongsTo('App\Blog','on_post');
    }

}
