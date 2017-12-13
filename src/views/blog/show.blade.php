@extends('backend.base')
@section('content')
<style type="text/css">
form input[type="submit"]{

    background: none;
    border: none;
    color: #4382bb;
    cursor: pointer;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="row">
      <div class="col-xs-12">
        @if($blog)
        <div class="panel-body">
        <h3>{{ $blog->title }}</h3>
        @if(!Auth::guest() && ($blog->author_id == Auth::user()->id || Auth::user()->is_admin()))
        <span style="float:right"><a href="{{ url('b/'.$blog->slug.'/edit')}}">Edit Post</a>
        <form class="form" role="form" method="POST" action="{{ url('/b/'. $blog->id) }}">
          <input type="hidden" name="_method" value="delete">
          {{ csrf_field() }}
          <input Onclick="return ConfirmDelete();" type="submit" value="Delete"></form>
        </span>
        @endif
        @else
        Page does not exist
        @endif
        <p>{{$blog->category->first()->name}} | {{ $blog->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$blog->author_id)}}">{{ $blog->author->name }}</a></p>
        </div>
        @if($blog)
          <div class="panel-body">
            <p><img class="img-responsive" src="{{ $blog->image }}"><br></img>
              {!! $blog->body !!}
            </p>
          </div>
          <hr>
          <div class="panel-body">
            <h4>Leave a comment</h4>
          </div>
          @if(Auth::guest())
            <p>Login to Comment</p>
          @else
            <div class="panel-body">
              <form method="post" action="/comment/add">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="on_post" value="{{ $blog->id }}">
                <input type="hidden" name="slug" value="{{ $blog->slug }}">
                <div class="form-group">
                  <textarea required="required" placeholder="Enter comment here" name = "body" class="form-control"></textarea>
                </div>
                <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
              </form>
            </div>
          @endif
          <div>
            @if($comments)
        <ul style="list-style: none; padding: 0">
          @foreach($comments as $comment)
            <li class="panel-body">
              <div class="list-group">
                <div class="list-group-item">
              <h3>{{ $comment->author->name }}</h3>
              <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
            </div>
            <div class="list-group-item">
              <p>{{ $comment->body }}</p>
            </div>
                </div>
              </li>
            @endforeach
          </ul>
          @endif
        </div>
      @else
      404 error
      @endif
      </div>
    </div>
    <!-- /.box -->
    <script>
        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x){
                return true;
            } else {
                return false;
            }
        }
    </script>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
