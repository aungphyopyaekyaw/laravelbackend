<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function blog() {
      return $this->hasMany('App\Blog','author_id');
    }

    public function comments() {
      return $this->hasMany('App\Comments','from_user');
    }

    public function can_post() {
      $type = $this->type;
      if($type == 'user' || $type == 'administrator') {
        return true;
      }
      return false;
    }

    public function is_admin() {
      $type = $this->type;
      if($type == 'administrator') {
        return true;
      }
      return false;
    }

}
