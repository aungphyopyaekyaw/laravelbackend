@extends('backend.base')
@section('content')
<div class="content-wrapper">
<section class="content">
<div class="register-box">
<div class="register-box-body">
  <p class="login-box-msg">Edit the user role</p>

  <form action="{{ url('/user/'.$users->id) }}" method="POST">
    <input type="hidden" name="_method" value="patch">
    {{ csrf_field() }}
    <div class="form-group has-feedback">
      <input id="name" name="name" type="text" value="{{ $users->name }}" class="form-control" placeholder="{{ old('name') }}">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input id="email" name="email" value="{{ $users->email }}" type="email" class="form-control" placeholder="{{ old('email') }}">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input id="password" name="password" type="password" class="form-control" placeholder="Password">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <!-- <input id="type" name="type" type="text" class="form-control" placeholder="User type"> -->
      <select id="s_type" onchange="run()">
        <option value="subscriber" selected="selected">Select One</option>
        <option value="administrator">Administrator</option>
        <option value="user">User | Editor</option>
        <option value="subscriber">Subscriber</option>
      </select>
      <input type="text" id="type" name="type" class="hidden"><br>
      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>
    <div class="row">
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
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
