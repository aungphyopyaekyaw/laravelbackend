@extends('backend.base')
@section('content')
<div class="content-wrapper">
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Create new post</h3>
    <!-- tools box -->
    <div class="pull-right box-tools">
      <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
    <!-- /. tools -->
    </div>
    <div class="box-body pad">
      <span>
        @foreach ($errors->all() as $error)
        <div class="callout callout-info">{{ $error }}</div>
        @endforeach
      </span>
      <form action="{{ asset('b/'.$blog->slug) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="patch">
        {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{ $blog->id or old('post_id') }}">
        <input required="required" name="title" value="{{ $blog->title }}" type="text" class="form-control" placeholder="Enter Title"><br>
        <textarea name="body" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $blog->body !!}</textarea>
        <div class="form-group">
          <select class="selectpicker form-control" name="category">
            @foreach($category as $c)
              @if($c->name==$blog->category->first()->name)
              <option value="{{$c->name}}" selected>{{$c->name}}</option>
              @else
              <option value="{{$c->name}}" >{{$c->name}}</option>
              @endif
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <img src="{{$blog->image}}" onclick="showStuff('image')" width="100px">
          <input id="image" name="image" style="display: none;" type="file">
        </div>
        <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
        <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />
    </form>
  </div>
</section>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  $(".selectpicker").select2({
    tags: true
  });

  function showStuff(id) {
    if(document.getElementById(id).style.display === "block") {
      document.getElementById(id).style.display = "none";
    } else {
      document.getElementById(id).style.display = "block";
    }
  }
</script>
@endpush
