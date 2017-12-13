<?php

namespace Agphyo\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Blog;

class UserController extends Controller {

  protected $user;

    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
          $this->user = Auth::user();
          if(Auth::user()->type <> 'administrator') {
              return redirect('backend');
          }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = $this->user;
        $usrs = User::paginate(50);
        return view('backend.usr_index', compact('usrs', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = $this->user;
        return view('backend.create_user', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Input::get();
        User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
            'type' => $user['type']
        ]);
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::where('id', $id)->first();
      $blog = Blog::where('author_id', $id)->paginate(5);
      return view('backend.profile', compact('user', 'blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = $this->user;
        $users = User::findOrFail($id);
        return view('backend.edit_user', compact('users', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        if(Input::get('password')){
            $user->password = bcrypt(Input::get('password'));
        } else {
            $user->password = $user->password;
        }
        $user->type = Input::get('type');
        $user->save();
        return $this->index();
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
        User::destroy($id);
        return $this->index();
    }
}
