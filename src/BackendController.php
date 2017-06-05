<?php

namespace Agphyo\Backend;

use App\Http\Controllers\Controller;
use App\User;

class BackendController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $users = User::paginate(50);
        return view('backend.usr_index', compact('users'));
    }

}
