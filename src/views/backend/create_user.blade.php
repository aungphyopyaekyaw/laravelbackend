@extends('backend.base')
@section('content')
<div class="content-wrapper">
<section class="content">
<div class="register-box">
<div class="register-box-body">
  <p class="login-box-msg">Create a new user</p>

  <form action="{{ asset('user') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group has-feedback">
      <input id="name" name="name" type="text" class="form-control" placeholder="Full name">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input id="email" name="email" type="email" class="form-control" placeholder="Email">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input id="password" name="password" type="password" class="form-control" placeholder="Password">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <!-- <input id="type" name="type" type="text" class="form-control" placeholder="User type"> -->
      <select id="s_type" onchange="run()">
        <option value="administrator">Administrator</option>
        <option value="user">User | Editor</option>
        <option value="subscriber" selected="selected">Subscriber</option>
      </select>
      <input type="text" id="type" name="type" class="hidden"><br>
      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>
    <div class="row">
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Create</button>
    </div>
    </div>
  </form>
  <script>
      function run() {
          document.getElementById("type").value = document.getElementById("s_type").value;
      }
  </script>
</div>
</div>
</section>
</div>
@endsection
