@extends ('layouts.app')
@section('content')
@include('useradm.create')
<div class="panel panel-default">
    <div class="panel-heading">
        List of users
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>           
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Edit</th>
                </tr>
            </thead>
            @foreach($users as $user)
            <tr>
                <td>{{$user->idUser}}</td>
                <td>{{$user->name}}</td>
                <td>@foreach($user->roles as $role){{ $role->name }}@endforeach</td>  
                <td></td>  
            </tr>
            @endforeach

        </table>
    </div>
</div>

@stop




