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
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">User Table</h3>

            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
              @foreach($usrs as $u)
              <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->type }}</td>
                <td><a href="/user/{{ $u->id }}/edit"><button type="button" class="btn btn-default">Edit </button></a></td>
                <td><form class="form" role="form" method="POST" action="{{ url('/user/'. $u->id) }}">
                  <input type="hidden" name="_method" value="delete">
                  {{ csrf_field() }}
                  <input class="btn btn-danger" Onclick="return ConfirmDelete();" type="submit" value="Delete"></form>
                </td>
              </tr>
              @endforeach
            </table>
            {{ $usrs->links() }}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
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
