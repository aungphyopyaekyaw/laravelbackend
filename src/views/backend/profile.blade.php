@extends('backend.base')
@section('content')
<div class="content-wrapper">
<style media="screen">
.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    width: 110px;
    height: 110px;
}
</style>
  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ $user->image }}" alt="User profile picture">

            <h3 class="profile-username text-center">{{ $user->name }}</h3>

            <p class="text-muted text-center">{{ $user->type }}</p>

            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal"><b>Upload profile picture</b></button>
          </div>
          <!-- /.box-body -->
        </div>

        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

    <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Upload Image</h4>
            </div>
            <div class="modal-body">
              <form action="{{ url('/upload') }}" class="col-md-6" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="Image">Image</label>
                  <input type="file" name="image">
                </div>
              </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-default" value="Upload">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
          </div>

        </div>
      </div>
        <!-- /.box -->

      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
            <li><a href="#settings" data-toggle="tab">Settings</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <!-- Post -->
              @foreach($blog as $b)
              <div class="post">
                <div class="user-block">
                  <a href="{{ url('b/'.$b->slug) }}">{{ $b->title }}</a>
                  <div>{{ $b->created_at->format('M d,Y \a\t h:i a') }}</div>
                </div>
                <!-- /.user-block -->
                <p>
                  {!! str_limit($b->body, $limit = 500, $end = '... <a href='.url("b/".$b->slug).'>Read More</a>') !!}
                </p>
              </div>
              @endforeach
              {{ $blog->links() }}
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->

            <!-- /.tab-pane -->

            <div class="tab-pane" id="settings">
              <form class="form-horizontal" action="{{ asset('/update') }}" method="POST">
                <input type="hidden" name="_method" value="patch">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $user->name }}" id="inputName" name="name" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" value="{{ $user->email }}" id="inputEmail" name="email" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </form>
            </div>

            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
@endsection
