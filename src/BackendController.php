<?php

namespace Agphyo\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;

class BackendController extends Controller {

  protected $user;

    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index() {
        echo "this is index";
    }

    public function profile() {
        $user = $this->user;
        return view('backend.profile', compact('user'));
    }

    public function upload(Request $request) {
      $user = User::findOrFail($this->user->id);
      if(Input::file()) {
          $image = Input::file('image');
          if($image->getMimeType() <> 'image/jpeg') {
              throw new \Exception("Only jpeg is allowed", 1);
          }
          $image->move(public_path() . '/profilepics/', $image->getClientOriginalName());
          $user->image = '/profilepics/' . $image->getClientOriginalName();
          $user->save();
         }
      return redirect('profile');
    }

    public function update(Request $request) {
        $user = User::findOrFail($this->user->id);
        if(Input::get()) {
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            if(Input::get('password')) {
                $user->password = bcrypt(Input::get('password'));
            } else {
                $user->password = $user->password;
            }
            $user->save();
        }
        return redirect('profile');
    }

}
