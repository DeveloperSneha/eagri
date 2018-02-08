@extends('layouts.app')
@section('content')
@if(isset($role))
@include('roles.edit')
@else
@include('roles.create')
@endif
<div class="panel panel-default">
  <div class="panel-heading">
    <strong>Roles</strong>
  </div>
  <div class="panel-body">
    <table  class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($roles as $role)
        <tr>
          <td>{{ $role->idRole }}</td>
          <td>{{ $role->name }}</td>
          <td>
              <a href="{{ url('roles/' . $role->idRole . '/edit') }}" class="btn btn-xs btn-warning">Edit role</a>
              <a href="{{ url('roles/' . $role->idRole . '/permissions') }}" class="btn btn-xs btn-danger">Assign Permissions</a>
          </td>
        </tr>
        @endforeach
      </tbody>
      
    </table>
  </div>
</div>
@stop
