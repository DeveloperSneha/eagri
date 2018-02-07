@extends('layouts.app')
@section('content')
{!! Form::open(['url' => 'roles/'.$role->idRole.'/permissions', 'class' => 'form-horizontal']) !!}
<div class="panel panel-default">
  <div class="panel-heading">
      <strong>Assign Permissions to : {{$role->name}}</strong>
  </div>
  <div class='panel-body'>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>SNo.</th>
          <th>Permission</th>
          <th>Allow</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @foreach($permissions as $permission)
        <tr>
          <td>{{ $i }}</td>
          <td>{{ $permission->label }}</td>
          <td> 
            <input type="checkbox" name="permission_id[]" value="{{ $permission->idPermission }}" @if($role->permissions->contains('name',$permission->name)) checked @endif >
          </td>
        </tr>
        <?php $i++; ?>
        @endforeach
      </tbody>
      <tfoot>
        <tr></tr>
      </tfoot>
    </table>

  </div>

  <div class="panel-footer">
    <button type="submit" class="btn btn-danger">Save</button>
  </div>
</div>
{!! Form::close() !!}
@stop