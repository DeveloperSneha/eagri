@extends('layouts.app')
@section('content')
@if(isset($permission))
@include('permissions.edit')
@else
@include('permissions.create')
@endif
<div class="panel panel-default">
  <div class="panel-heading">
    <strong>Permissions</strong>
  </div>
  <div class="panel-body">
    <table  class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($permissions as $permission)
        <tr>
          <td>{{ $permission->label }}</td>
          <td><a href="{{ url('permissions/' . $permission->idPermission . '/edit') }}" class="btn btn-xs btn-danger">Edit</a></td>
        </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</div>
@stop