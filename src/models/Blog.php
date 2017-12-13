<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    public function comments() {
      return $this->hasMany('App\Comments','on_post');
    }

    public function author() {
      return $this->belongsTo('App\User','author_id');
    }

    public function category() {
      return $this->belongsToMany('App\Category')->withTimestamps();
    }
}
