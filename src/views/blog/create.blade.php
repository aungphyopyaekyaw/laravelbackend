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
      <form action="{{ asset('b') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input required="required" name="title" type="text" class="form-control" placeholder="Enter Title"><br>
        <textarea name="body" class="summernote" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
        <div class="form-group">
          <select class="selectpicker form-control" name="category">
            <option value="Uncategorized">Select or create category</option>
            @foreach($category as $c)
            <option value="{{$c->name}}" >{{$c->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <input id="image" name="image" type="file">
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
</script>
@endpush
