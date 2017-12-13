@extends('backend.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="row">
      <div class="col-xs-12">
        @foreach( $blog as $post )
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><a href="{{ url('b/'.$post->slug) }}">{{ $post->title }}</a></h3>
            <span style="float:right">
              @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                @if($post->active == '1')
                <a href="{{ url('b/'.$post->slug.'/edit')}}">Edit Post</a>
                @else
                <a href="{{ url('b/'.$post->slug.'/edit')}}">Edit Draft</a>
                @endif
              @endif
            </span>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">

                <article>
                  {!! str_limit($post->body, $limit = 1500, $end = '... <a href='.url("b/".$post->slug).'>Read More</a>') !!}
                </article>

          </div>
          <div class="box-footer">
            <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
            <span style="float:right">Category : {{$post->category->first()->name}}</span></p>
          </div>
          <!-- /.box-body -->
        </div>
        @endforeach
        {!! $blog->render() !!}
        <!-- /.box -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
